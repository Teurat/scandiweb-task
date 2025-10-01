<?php
namespace Teurat\Scandiweb\GraphQL\Type;

use GraphQL\Type\Definition\{ObjectType, Type};

final class AttributeValueType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name'   => 'AttributeValue',
            'fields' => [
                'id'      => Type::nonNull(Type::string()),
                'display' => Type::string(),
                'value'   => Type::string(),
            ],
        ]);
    }
}
