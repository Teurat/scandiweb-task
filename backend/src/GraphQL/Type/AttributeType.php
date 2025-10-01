<?php
namespace Teurat\Scandiweb\GraphQL\Type;

use GraphQL\Type\Definition\{ObjectType, Type};
use Teurat\Scandiweb\GraphQL\AppTypes;

final class AttributeType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name'   => 'Attribute',
            'fields' => [
                'label'  => Type::nonNull(Type::string()),
                'type'   => Type::nonNull(Type::string()),
                'values' => Type::nonNull(
                    Type::listOf(AppTypes::attributeValue())
                ),
            ],
        ]);
    }
}
