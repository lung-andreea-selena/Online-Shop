<?php

// Include the necessary controllers
require_once './controllers/productController.php';
require_once './controllers/cartController.php';
require_once './controllers/orderController.php';
require_once './controllers/reportController.php';

// Check which controller and action to execute
$controller = $_GET['controller'] ?? 'product';  // Default to 'product' if none specified
$action = $_GET['action'] ?? 'getAllProducts';            // Default to 'index' if none specified
// Routing logic
switch ($controller) {
    case 'product':
        $productController = new ProductController();

        if ($action === 'getProductById') {
            // Show product details
            $product_id = $_GET['product_id'] ?? null;
            if ($product_id) {
                $productController->getProductById($product_id);
            } else {
                $productController->getAllProducts();  // Default to product list if no ID is provided
            }
        } else {
            // Show the homepage (product list)
            $productController->getAllProducts();
        }
        break;

    case 'cart':
        $cartController = new CartController();

        if ($action === 'viewCart') {
            // Show the cart page
            $cartController->viewCart();
        } elseif ($action === 'addToCart') {
            $cartController->addToCart();
        } elseif ($action === 'removeFromCart') {
            $cartController->removeFromCart();
        }
        break;

    case 'order':  // Add the case for OrderController
        $orderController = new OrderController();

        if ($action === 'submitOrder') {
            // Handle order submission
            $orderController->submitOrder();
        } elseif ($action === 'orderSuccess') {
            // Show order success page
            $orderController->orderSuccess();
        } elseif ($action === 'checkout') {
            $orderController->checkout();
        }
        break;
    case 'report':
        $reportController = new ReportController();
        if ($action === 'showReport') {
            $reportController->showReport();
        }
        break;

    default:
        // If no valid controller is found, show the homepage (product list)
        $productController = new ProductController();
        $productController->getAllProducts();
        break;
}
