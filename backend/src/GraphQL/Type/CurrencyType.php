<?php
namespace Teurat\Scandiweb\GraphQL\Type;

use GraphQL\Type\Definition\{ObjectType, Type};

final class CurrencyType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name'   => 'Currency',
            'fields' => [
                'label' => Type::nonNull(Type::string()),
                'code'  => Type::string(),
                'symbol'=> Type::nonNull(Type::string()),
            ],
            'resolveField' => function ($cur, $args, $ctx, $info) {
                switch ($info->fieldName) {
                    case 'label':
                        return $cur['label'] ?? ($cur->label ?? ($cur['code'] ?? ($cur->code ?? null)));
                    case 'code':
                        return $cur['code']  ?? ($cur->code  ?? ($cur['label'] ?? ($cur->label ?? null)));
                    case 'symbol':
                        return $cur['symbol'] ?? ($cur->symbol ?? null);
                }
                return null;
            },
        ]);
    }
}
