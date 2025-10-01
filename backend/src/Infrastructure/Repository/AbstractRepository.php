<?php
declare(strict_types=1);

namespace Teurat\Scandiweb\Infrastructure\Repository;

use PDO;

abstract class AbstractRepository
{
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}
