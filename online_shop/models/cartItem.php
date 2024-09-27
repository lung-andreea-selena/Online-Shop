<?php
require_once __DIR__ . '/../config/database.php';
require_once 'models/cart.php';
class CartItem
{
    private $product_id;
    private $quantity;
    private $product;

    public function __construct($product_id, $quantity)
    {
        $this->product_id = $product_id;
        $this->quantity = $quantity;

        $this->product = (new Product())->getProductById($product_id);
    }

    public function getProductId()
    {
        return $this->product_id;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function updateQuantity($quantity)
    {
        $this->quantity += $quantity;
    }


    public function getTotalPrice()
    {
        return $this->product->calculatePrice() * $this->quantity;
    }

    public function getProductName()
    {
        return $this->product->getName();
    }

    public function getPriceWithVAT()
    {
        return $this->product->calculatePrice();
    }
}
