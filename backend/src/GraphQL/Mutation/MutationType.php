<?php
namespace Teurat\Scandiweb\GraphQL\Mutation;

use GraphQL\Type\Definition\{ObjectType, Type};
use Teurat\Scandiweb\GraphQL\AppTypes;
use Teurat\Scandiweb\Infrastructure\Repository\OrderRepository;

final class MutationType extends ObjectType
{
    public function __construct(private OrderRepository $orderRepository)
    {
        parent::__construct([
            'name'   => 'Mutation',
            'fields' => [
                'createOrder' => [
                    'type' => AppTypes::order(),
                    'args' => [
                        'items' => Type::nonNull(
                            Type::listOf(AppTypes::orderItemInput())
                        ),
                    ],
                    'resolve' => function($_, array $args) {
                        $orderId = $this->orderRepository->create($args['items']);

                        $createdAt = (new \DateTime())->format('Y-m-d H:i:s');

                        return [
                            'id' => $orderId,
                            'createdAt' => $createdAt,
                        ];
                    },
                ],
            ],
        ]);
    }
}
