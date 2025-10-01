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
                'code'   => Type::nonNull(Type::string()), 
                'symbol' => Type::nonNull(Type::string()), 
            ],
        ]);
    }
}
