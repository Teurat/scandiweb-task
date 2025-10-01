<?php
namespace Teurat\Scandiweb\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use Teurat\Scandiweb\Domain\Category\Category;

final class CategoryType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name'   => 'Category',
            'fields' => [
                'name' => Type::nonNull(Type::string()),
            ],
            'resolveField' => function (Category $category, $args, $context, $info) {
                return match ($info->fieldName) {
                    'name' => $category->getName(),
                    default => null,
                };
            },
        ]);
    }
}
