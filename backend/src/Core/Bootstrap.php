<?php
declare(strict_types=1);

namespace Teurat\Scandiweb\Core;

use GraphQL\Type\Schema;
use Teurat\Scandiweb\GraphQL\Query\QueryType;
use Teurat\Scandiweb\GraphQL\Mutation\MutationType;
use Teurat\Scandiweb\Infrastructure\Repository\{
    ProductRepository,
    CategoryRepository,
    CurrencyRepository,
    OrderRepository
};

final class Bootstrap
{
    public function __construct()
    {
        Env::load(dirname(__DIR__, 2));
        $pdo = Database::getInstance();

        $this->categoryRepo = new CategoryRepository($pdo);
        $this->productRepo  = new ProductRepository($pdo);
        $this->currencyRepo = new CurrencyRepository($pdo);   
        $this->orderRepo    = new OrderRepository($pdo);

        $this->schema = new Schema([
            'query'    => new QueryType(
                $this->productRepo,
                $this->categoryRepo,
                $this->currencyRepo        
            ),
            'mutation' => new MutationType($this->orderRepo),
        ]);
    }

    public function getSchema(): Schema 
    { 
        return $this->schema; 
    }

    private CategoryRepository $categoryRepo;
    private ProductRepository  $productRepo;
    private CurrencyRepository $currencyRepo;   
    private OrderRepository    $orderRepo;
    private Schema             $schema;
}
