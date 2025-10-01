<?php
namespace Teurat\Scandiweb\GraphQL\Type;

use GraphQL\Type\Definition\{ObjectType, Type};
use Teurat\Scandiweb\GraphQL\AppTypes;


final class PriceType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name'   => 'Price',
            'fields' => [
                'amount'   => Type::nonNull(Type::float()),

                'currency' => [
                    'type'    => AppTypes::currency(),
                    'resolve' => fn(array $price) => [
                        'code'   => $price['code']   ?? null,
                        'symbol' => $price['symbol'] ?? null,
                    ],
                ],
            ],
        ]);
    }
}
