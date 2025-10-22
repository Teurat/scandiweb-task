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
                'currency' => Type::nonNull(AppTypes::currency()),
            ],
            'resolveField' => function ($price, $args, $ctx, $info) {
                if ($info->fieldName === 'amount') {
                    return $price['amount'] ?? $price->amount ?? null;
                }
                if ($info->fieldName === 'currency') {
                    $c = $price['currency'] ?? $price->currency ?? null;
                    if (is_array($c)) {
                        return [
                            'label'  => $c['label'] ?? $c['code'] ?? null,
                            'symbol' => $c['symbol'] ?? null,
                        ];
                    }
                    return [
                        'label'  => $price['label'] ?? $price->label ?? $price['code'] ?? $price->code ?? null,
                        'symbol' => $price['symbol'] ?? $price->symbol ?? null,
                    ];
                }
                return null;
            },
        ]);
    }
}
