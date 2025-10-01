<?php
declare(strict_types=1);

namespace Teurat\Scandiweb\Domain\Product;

abstract class AbstractProduct
{
    public function __construct(array $row)
    {
        $this->sku       = (string) $row['product_id'];
        $this->name      = (string) $row['name'];
        $this->inStock   = (bool)   $row['in_stock'];
        $this->brand     = (string) ($row['brand']     ?? '');
        $this->category  = (string) ($row['category']  ?? '');

        $this->gallery    = [];
        $this->prices     = [];
        $this->attributes = [];
    }

    public string $sku;
    public string $name;
    public bool   $inStock;
    public string $brand;
    public string $category;

    /** @var string[] */
    public array $gallery;

    /** @var array[] [{amount:float, currency:{code,symbol}}] */
    public array $prices;

    /** @var array[] [{label,type,values:[{id,display,value}]}] */
    public array $attributes;

    public function getSku(): string       { return $this->sku; }
    public function getName(): string      { return $this->name; }
    public function isInStock(): bool      { return $this->inStock; }
    public function getBrand(): string     { return $this->brand; }
    public function getCategory(): string  { return $this->category; }

}
