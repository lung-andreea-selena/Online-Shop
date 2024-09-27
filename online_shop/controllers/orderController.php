<?php

require_once __DIR__ . '/../models/order.php';
require_once __DIR__ . '/../models/orderItem.php';
require_once __DIR__ . '/../models/cart.php';

class OrderController
{
    public function submitOrder()
    {
        $customer_name = $_POST['customer_name'];
        $customer_email = $_POST['customer_email'];
        $customer_phone = $_POST['customer_phone'];
        $customer_address = $_POST['customer_address'];
        $total_amount = $_POST['total_amount'];

        $order = new Order($customer_name, $customer_email, $customer_phone, $customer_address, $total_amount);

        $cart = new Cart();
        $items = $cart->getItems();


        foreach ($items as $cartItem) {
            $orderItem = new OrderItem($cartItem->getProductId(), $cartItem->getQuantity(), $cartItem->getPriceWithVAT());
            $order->addItem($orderItem);
        }

        $order->save();

        $cart->clearCart();

        header("Location: /online_shop/index.php?controller=order&action=orderSuccess");
        exit();
    }

    public function checkout()
    {
        $cart = new Cart();  // Load the cart to display the total
        include __DIR__ . '/../views/checkout_view.php';  // Display the checkout page
    }

    public function orderSuccess()
    {
        include __DIR__ . '/../views/order_success_view.php';
    }
}
