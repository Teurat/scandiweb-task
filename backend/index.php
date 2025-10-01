<?php
declare(strict_types=1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use Teurat\Scandiweb\Core\Bootstrap;
use GraphQL\Server\{StandardServer, ServerConfig};
use GraphQL\Error\DebugFlag;

Dotenv::createImmutable(__DIR__)->safeLoad();

$schema = (new Bootstrap())->getSchema();

$config = ServerConfig::create()
    ->setSchema($schema)
    ->setDebugFlag(DebugFlag::INCLUDE_DEBUG_MESSAGE | DebugFlag::INCLUDE_TRACE);

(new StandardServer($config))->handleRequest();
