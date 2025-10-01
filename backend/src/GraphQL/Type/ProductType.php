<?php
namespace Teurat\Scandiweb\GraphQL\Type;

use GraphQL\Type\Definition\{ObjectType, Type};
use Teurat\Scandiweb\GraphQL\AppTypes;

final class ProductType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name'   => 'Product',
            'fields' => function (): array {
                return [
                    'id'   => [
                        'type'    => Type::nonNull(Type::string()),
                        'resolve' => fn($product) => $product->sku
                    ],

                    'sku'       => Type::nonNull(Type::string()),
                    'name'      => Type::nonNull(Type::string()),
                    'inStock'   => Type::nonNull(Type::boolean()),
                    'gallery'   => Type::nonNull(Type::listOf(Type::string())),

                    'prices'    => Type::nonNull(
                        Type::listOf(AppTypes::price())
                    ),
                    'attributes' => Type::nonNull(
                        Type::listOf(AppTypes::attribute())
                    ),

                    'description' => Type::string(),
                ];
            },

            'resolveField' => function ($product, $args, $context, $info) {
                return $product->{$info->fieldName} ?? null;
            },
        ]);
    }
}
