<?php
require_once __DIR__ . '/../models/cart.php';
require_once __DIR__ . '/../models/cartItem.php';
//viewCart()
class CartController
{
    public function addToCart()
    {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'] ?? 1;

        $cart = new Cart();
        $cart->addItem($product_id, $quantity);
        //refresh
        header("Location: /online_shop/index.php?controller=cart&action=viewCart");
    }

    public function viewCart()
    {
        $cart = new Cart();
        include __DIR__ . '/../views/cart_view.php';
    }

    public function removeFromCart()
    {
        $product_id = $_GET['product_id'];

        $cart = new Cart();
        $cart->removeItem($product_id);

        header("Location: /online_shop/index.php?controller=cart&action=viewCart");
    }
}
