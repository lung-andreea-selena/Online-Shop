<?php
require_once __DIR__ . '/../config/database.php';
require_once 'category.php';

//I am only making the Product class and adding a boolean attribute for the tax because
// From the task it seems that the tax does not influence that most in order to make the new class
// In this way we keep it simpler
class Product
{
    private $db;
    private $categoryModel;
    private $product_id;
    private $product_name;
    private $product_description;
    private $product_price;
    private $product_tva;
    private $categories = [];

    public function __construct($product_id = null, $product_name = '', $product_description = '', $product_price = 0, $product_tva = false)
    {
        $this->db = new Database();
        $this->categoryModel = new Category();
        $this->product_id = $product_id;
        $this->product_name = $product_name;
        $this->product_description = $product_description;
        $this->product_price = $product_price;
        $this->product_tva = $product_tva;
    }

    public function getProductById($product_id)
    {
        $sql = "SELECT * FROM product WHERE product_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $productData = $result->fetch_assoc();

        if ($productData) {
            $product = new Product(
                $productData['product_id'],
                $productData['product_name'],
                $productData['product_description'],
                $productData['product_price'],
                $productData['product_tva']
            );
            $product->categories = $this->categoryModel->getCategoriesForProduct($productData['product_id']);
            return $product;
        }
        return null;
    }

    public function getAllProducts()
    {
        $sql = "SELECT * FROM product";
        $result = $this->db->query($sql);
        $products = [];

        while ($row = $result->fetch_assoc()) {
            $product = new Product(
                $row['product_id'],
                $row['product_name'],
                $row['product_description'],
                $row['product_price'],
                $row['product_tva']
            );
            $product->categories = $this->categoryModel->getCategoriesForProduct($row['product_id']);
            $products[] = $product;
        }

        return $products;
    }

    public function calculatePrice()
    {
        if ($this->product_tva) {
            return $this->product_price + ($this->product_price * 0.10);  // 10% tva
        }
        return $this->product_price;
    }

    public function getId()
    {
        return $this->product_id;
    }

    public function getName()
    {
        return $this->product_name;
    }

    public function getDescription()
    {
        return $this->product_description;
    }

    public function getPrice()
    {
        return $this->product_price;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function getIfTva()
    {
        return $this->product_tva;
    }
}
