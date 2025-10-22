<?php
declare(strict_types=1);

namespace Teurat\Scandiweb\Domain\Product;

final class Product
{
    public function __construct(
        public string|int $id,
        public string $name,
        public bool $inStock,
        public string $brand,
        public string $category,
        public array $gallery,
        public array $prices,
        public array $attributes,
        public string $description = ''
    ) {}

    public static function fromRow(array $row): self
    {
        return new self(
            id: $row['product_id'] ?? $row['id'] ?? '',
            name: $row['name'] ?? '',
            inStock: (bool)($row['in_stock'] ?? $row['inStock'] ?? false),
            brand: $row['brand'] ?? '',
            category: $row['category'] ?? '',
            gallery: is_string($row['gallery'] ?? null) ? (json_decode($row['gallery'], true) ?: []) : ($row['gallery'] ?? []),
            prices: is_string($row['prices'] ?? null) ? (json_decode($row['prices'], true) ?: []) : ($row['prices'] ?? []),
            attributes: is_string($row['attributes'] ?? null) ? (json_decode($row['attributes'], true) ?: []) : ($row['attributes'] ?? []),
            description: $row['description'] ?? ''
        );
    }
}
