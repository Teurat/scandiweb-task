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
                    'id' => [
                        'type'    => Type::nonNull(Type::string()),
                        'resolve' => fn($p) => (string)($p->id ?? ($p['id'] ?? ($p->sku ?? ''))),
                    ],

                    'sku' => [
                        'type'    => Type::string(),
                        'resolve' => fn($p) => isset($p->sku)
                            ? (string)$p->sku
                            : (string)($p->id ?? ($p['id'] ?? null)),
                    ],

                    'name'      => Type::nonNull(Type::string()),
                    'inStock'   => Type::nonNull(Type::boolean()),
                    'brand'     => Type::nonNull(Type::string()),
                    'category'  => Type::nonNull(Type::string()),
                    'gallery'   => Type::nonNull(Type::listOf(Type::nonNull(Type::string()))),

                    'prices'     => Type::nonNull(Type::listOf(AppTypes::price())),
                    'attributes' => Type::nonNull(Type::listOf(AppTypes::attribute())),
                    'description'=> Type::string(),
                ];
            },

            'resolveField' => function ($product, $args, $context, $info) {
                $field = $info->fieldName;
                if (is_object($product) && isset($product->{$field})) {
                    return $product->{$field};
                }
                if (is_array($product) && array_key_exists($field, $product)) {
                    return $product[$field];
                }
                return null;
            },
        ]);
    }
}
