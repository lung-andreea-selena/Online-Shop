<?php

class Category
{
    private $db;
    private $category_id;
    private $category_name;

    public function __construct($category_id = null, $category_name = '')
    {
        $this->db = new Database();
        $this->category_id = $category_id;
        $this->category_name = $category_name;
    }

    public function getCategoriesForProduct($product_id)
    {
        $sql = "SELECT category_id FROM product_categories WHERE product_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $categoryIds = $result->fetch_all(MYSQLI_ASSOC);
        $categories = [];

        foreach ($categoryIds as $categoryId) {
            $categories[] = $this->getCategoryById($categoryId['category_id']);
        }

        $stmt->close();

        return $categories;
    }

    // Get category by ID and return a Category object
    public function getCategoryById($category_id)
    {
        $sql = "SELECT * FROM category WHERE category_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $category_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $categoryData = $result->fetch_assoc();

        if ($categoryData) {
            return new Category($categoryData['category_id'], $categoryData['category_name']);
        }

        $stmt->close();

        return null;  // Return null if no category found
    }

    public function getId()
    {
        return $this->category_id;
    }

    public function getName()
    {
        return $this->category_name;
    }
}
