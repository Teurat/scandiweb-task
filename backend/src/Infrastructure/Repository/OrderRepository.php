<?php
declare(strict_types=1);

namespace Teurat\Scandiweb\Infrastructure\Repository;

final class OrderRepository extends AbstractRepository
{
    protected const TABLE = 'orders';

    /** @param array{sku:string,qty:int}[] $items */
    public function create(array $items): int
    {
        $this->pdo->beginTransaction();
        $this->pdo->exec("INSERT INTO orders(created_at) VALUES (NOW())");
        $orderId = (int)$this->pdo->lastInsertId();

        $stmt = $this->pdo->prepare(
            'INSERT INTO order_items(order_id, product_id, qty) VALUES (:oid, :pid, :qty)'
        );

        foreach ($items as $item) {
            $stmt->execute([
                ':oid' => $orderId,
                ':pid' => $item['sku'],
                ':qty' => $item['qty'],
            ]);
        }

        $this->pdo->commit();
        return $orderId;
    }

    protected function mapRow(array $row): array
    {
        return [
            'id' => (int)$row['id'],
            'created_at' => $row['created_at'] ?? null,
        ];
    }
}
