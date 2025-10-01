<?php
namespace Teurat\Scandiweb\GraphQL;

use Teurat\Scandiweb\GraphQL\Type\{
    ProductType, CategoryType, CurrencyType,
    PriceType, AttributeType, AttributeValueType,
    OrderItemInputType, OrderType
};

final class AppTypes
{
    public static function order(): OrderType
    { return self::$order ??= new OrderType(); }

    public static function product(): ProductType
    { return self::$product ??= new ProductType(); }

    public static function category(): CategoryType
    { return self::$category ??= new CategoryType(); }

    public static function currency(): CurrencyType
    { return self::$currency ??= new CurrencyType(); }

    public static function price(): PriceType
    { return self::$price ??= new PriceType(); }

    public static function attribute(): AttributeType
    { return self::$attribute ??= new AttributeType(); }

    public static function attributeValue(): AttributeValueType
    { return self::$attributeValue ??= new AttributeValueType(); }

    public static function orderItemInput(): OrderItemInputType
    { return self::$orderItemInput ??= new OrderItemInputType(); }

    private static ProductType         $product;
    private static CategoryType        $category;
    private static CurrencyType        $currency;
    private static PriceType           $price;
    private static AttributeType       $attribute;
    private static AttributeValueType  $attributeValue;       
    private static OrderItemInputType  $orderItemInput;
    private static OrderType           $order;
}
