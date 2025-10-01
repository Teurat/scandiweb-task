<?php
namespace Teurat\Scandiweb\Domain\Category;

final class Category
{
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    private string $name;
}
