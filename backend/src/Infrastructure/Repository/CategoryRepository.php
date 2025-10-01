<?php
namespace Teurat\Scandiweb\Infrastructure\Repository;

use PDO;
use Teurat\Scandiweb\Domain\Category\Category;

final class CategoryRepository extends AbstractRepository
{
    /** @return Category[] */
    public function getAll(): array
    {
        $rows = $this->pdo
            ->query('SELECT name FROM category')
            ->fetchAll(PDO::FETCH_COLUMN);

        return array_map(fn(string $name) => new Category($name), $rows);
    }
}
