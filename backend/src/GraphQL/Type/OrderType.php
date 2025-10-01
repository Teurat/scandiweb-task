<?php
namespace Teurat\Scandiweb\GraphQL\Type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

final class OrderType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Order',
            'fields' => [
                'id' => Type::nonNull(Type::int()),
                'createdAt' => Type::nonNull(Type::string()),
            ]
        ]);
    }
}
