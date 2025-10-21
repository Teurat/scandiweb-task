<?php
declare(strict_types=1);

namespace Teurat\Scandiweb\Infrastructure\Repository;

final class CurrencyRepository extends AbstractRepository
{
    protected const TABLE = 'currency';

    protected function mapRow(array $row): array
    {
        return [
            'code' => $row['code'],
            'symbol' => $row['symbol'],
        ];
    }
}
