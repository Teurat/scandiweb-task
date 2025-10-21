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
        /** @var string[] */
        public array $gallery,
        /** @var array<int, array{amount: float, currency: array{label: string, symbol: string}}> */
        public array $prices,
        /** @var array<int, array{name: string, type: string, items: array<int, array{displayValue: string, value: string, id: string}>}> */
        public array $attributes,
        public string $description,
    ) {}

    public static function fromRow(array $row): self
    {
        return new self(
            $row['id'],
            $row['name'],
            (bool)($row['in_stock'] ?? $row['inStock'] ?? 0),
            $row['brand'] ?? '',
            $row['category'] ?? '',
            is_string($row['gallery'] ?? null) ? (json_decode($row['gallery'], true) ?: []) : ($row['gallery'] ?? []),
            is_string($row['prices'] ?? null) ? (json_decode($row['prices'], true) ?: []) : ($row['prices'] ?? []),
            is_string($row['attributes'] ?? null) ? (json_decode($row['attributes'], true) ?: []) : ($row['attributes'] ?? []),
            $row['description'] ?? '',
        );
    }
}
