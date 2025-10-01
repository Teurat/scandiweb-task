<?php
namespace Teurat\Scandiweb\GraphQL\Type;

use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;

final class OrderItemInputType extends InputObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name'   => 'OrderItemInput',
            'fields' => [
                'sku' => Type::nonNull(Type::string()),
                'qty' => Type::nonNull(Type::int()),
            ],
        ]);
    }
}
