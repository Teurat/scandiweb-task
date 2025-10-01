<?php
namespace Teurat\Scandiweb\GraphQL\Query;

use GraphQL\Type\Definition\{ObjectType, Type};
use Teurat\Scandiweb\GraphQL\AppTypes;
use Teurat\Scandiweb\Infrastructure\Repository\{
    ProductRepository,
    CategoryRepository,
    CurrencyRepository
};

final class QueryType extends ObjectType
{
    public function __construct(
        private ProductRepository  $productRepository,
        private CategoryRepository $categoryRepository,
        private CurrencyRepository $currencyRepository
    ) {
        parent::__construct([
            'name'   => 'Query',
            'fields' => [
                'products' => [
                    'type' => Type::listOf(AppTypes::product()),
                    'args' => [
                        'category' => [
                            'type'        => Type::string(),
                            'description' => 'Category name (e.g. tech, clothes)',
                        ],
                    ],
                    'resolve' => fn($_, array $args) =>
                        $this->productRepository->getAll($args['category'] ?? null),
                ],
                'product' => [
                    'type' => AppTypes::product(),
                    'args' => [
                        'id' => Type::nonNull(Type::id()),
                    ],
                    'resolve' => fn($_, array $args) =>
                        $this->productRepository->getById($args['id']),
                ],
                'categories' => [
                    'type'    => Type::listOf(AppTypes::category()),
                    'resolve' => fn() => $this->categoryRepository->getAll(),
                ],
                'currencies' => [
                    'type'    => Type::listOf(AppTypes::currency()),
                    'resolve' => fn() => $this->currencyRepository->getAll(),
                ],
            ],
        ]);
    }
}
