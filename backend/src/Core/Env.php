<?php
namespace Teurat\Scandiweb\Core;

use Dotenv\Dotenv;

final class Env
{
    public static function load(string $root): void
    {
        (Dotenv::createImmutable($root))->safeLoad();
    }
}
