<?php
declare(strict_types=1);

namespace Teurat\Scandiweb\Infrastructure\Repository;

use Teurat\Scandiweb\Domain\Category\Category;

final class CategoryRepository extends AbstractRepository
{
    protected const TABLE = 'category';

    protected function mapRow(array $row): Category
    {
        return new Category($row['name']);
    }
}
