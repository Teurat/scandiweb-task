<?php
declare(strict_types=1);

namespace Teurat\Scandiweb\Infrastructure\Repository;

use Teurat\Scandiweb\Domain\Product\Product;
use PDO;

final class ProductRepository extends AbstractRepository
{
    protected const TABLE = 'product';

    /** @return Product[] */
    public function getAll(?string $category = null): array
    {
        $sql = 'SELECT * FROM product';
        $params = [];

        if ($category && strtolower($category) !== 'all') {
            $sql .= ' WHERE LOWER(category) = LOWER(:cat)';
            $params[':cat'] = $category;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];

        return array_map(fn(array $row) => $this->mapRow($row), $rows);
    }

    public function getById(string|int $id): ?Product
    {
        $stmt = $this->pdo->prepare('SELECT * FROM product WHERE product_id = :id');
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? $this->mapRow($row) : null;
    }

    protected function mapRow(array $row): Product
    {
        $stmtGallery = $this->pdo->prepare('SELECT image_url FROM gallery WHERE product_id = ?');
        $stmtGallery->execute([$row['product_id']]);
        $gallery = array_column($stmtGallery->fetchAll(PDO::FETCH_ASSOC) ?: [], 'image_url');

        $stmtPrices = $this->pdo->prepare(
            'SELECT amount, c.code, c.symbol
               FROM price
               JOIN currency c USING(code)
              WHERE product_id = ?'
        );
        $stmtPrices->execute([$row['product_id']]);
        $priceRows = $stmtPrices->fetchAll(PDO::FETCH_ASSOC) ?: [];
        $prices = array_map(
            fn(array $p) => [
                'amount' => (float) $p['amount'],
                'currency' => [
                    'label'  => $p['code'],   
                    'symbol' => $p['symbol'],
                ],
            ],
            $priceRows
        );

        $stmtAttributes = $this->pdo->prepare(
            'SELECT s.attr_set_id, s.name, s.type,
                    i.item_id, i.display_val, i.value, i.ref_id
               FROM attribute_set s
               JOIN product_attribute pa USING(attr_set_id)
               JOIN attribute_item i     USING(attr_set_id)
              WHERE pa.product_id = ?
           ORDER BY s.attr_set_id, i.item_id'
        );
        $stmtAttributes->execute([$row['product_id']]);
        $attrRows = $stmtAttributes->fetchAll(PDO::FETCH_ASSOC) ?: [];

        $sets = [];
        foreach ($attrRows as $ar) {
            $sid = $ar['attr_set_id'];
            if (!isset($sets[$sid])) {
                $sets[$sid] = [
                    'label'  => $ar['name'],
                    'type'   => $ar['type'],
                    'values' => [],
                ];
            }
            $sets[$sid]['values'][] = [
                'id'      => $ar['ref_id'],
                'display' => $ar['display_val'],
                'value'   => $ar['value'],
            ];
        }
        $attributes = array_values($sets);

        return new Product(
            id: $row['product_id'],
            name: $row['name'] ?? '',
            inStock: (bool)($row['in_stock'] ?? 0),
            brand: $row['brand'] ?? '',
            category: $row['category'] ?? '',
            gallery: $gallery,
            prices: $prices,
            attributes: $attributes,
            description: $row['description'] ?? ''
        );
    }
}
