<?php
declare(strict_types=1);

namespace Teurat\Scandiweb\Infrastructure\Repository;

use PDO;

abstract class AbstractRepository
{
    protected PDO $pdo;
    protected const TABLE = '';

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll(): array
    {
        $sql = 'SELECT * FROM ' . static::TABLE;
        $stmt = $this->pdo->query($sql);
        $rows = $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
        if (!is_array($rows)) {
            $rows = [];
        }
        return array_map(fn(array $r) => $this->mapRow($r), $rows);
    }

    public function getById(int|string $id): mixed
    {
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $this->mapRow($row) : null;
    }

    abstract protected function mapRow(array $row): mixed;
}
