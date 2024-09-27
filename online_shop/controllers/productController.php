<?php

require_once __DIR__ . '/../models/product.php';

class ProductController
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new Product();
    }

    public function getAllProducts()
    {
        $products = $this->productModel->getAllProducts();
        include __DIR__ . '/../views/home_view.php'; // Load the view and pass data
    }

    public function getProductById($product_id)
    {

        $product = $this->productModel->getProductById($product_id);
        include __DIR__ . '/../views/details_view.php';
    }
}
