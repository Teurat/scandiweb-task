<?php
namespace Teurat\Scandiweb\Infrastructure\Repository;

use Teurat\Scandiweb\Domain\Product\{
    AbstractProduct,
    GenericProduct
};

final class ProductRepository extends AbstractRepository
{
    /** @return AbstractProduct[] */
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
        $rows = $stmt->fetchAll();

        return array_map(fn($row) => $this->hydrate($row), $rows);
    }

    public function getById(string $id): ?AbstractProduct
    {
        $stmt = $this->pdo->prepare('SELECT * FROM product WHERE product_id = :id');
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();

        return $row ? $this->hydrate($row) : null;
    }

    private function hydrate(array $row): AbstractProduct
    {
        $product = new GenericProduct($row);

        $stmtGallery = $this->pdo->prepare('SELECT image_url FROM gallery WHERE product_id = ?');
        $stmtGallery->execute([$row['product_id']]);
        $product->gallery = array_column($stmtGallery->fetchAll(), 'image_url');

        $stmtPrices = $this->pdo->prepare(
            'SELECT amount, c.code, c.symbol
               FROM price
               JOIN currency c USING(code)
              WHERE product_id = ?'
        );
        $stmtPrices->execute([$row['product_id']]);
        $product->prices = $stmtPrices->fetchAll();

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

        $sets = [];
        foreach ($stmtAttributes as $attributeRow) {
            $setId = $attributeRow['attr_set_id'];
            $sets[$setId]['label']    = $attributeRow['name'];
            $sets[$setId]['type']     = $attributeRow['type'];
            $sets[$setId]['values'][] = [
                'id'      => $attributeRow['ref_id'],
                'display' => $attributeRow['display_val'],
                'value'   => $attributeRow['value'],
            ];
        }
        $product->attributes  = array_values($sets);
        $product->description = $row['description'] ?? '';

        return $product;
    }
}
