<?php
require_once __DIR__ . '/../config/database.php';
require_once 'models/order.php';
class OrderItem
{
    private $db;
    private $product_id;
    private $quantity;
    private $price;

    public function __construct($product_id, $quantity, $price)
    {
        $this->db = new Database();
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    public function save($order_id)
    {
        // Save the order item to the database
        $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iiid", $order_id, $this->product_id, $this->quantity, $this->price);
        $stmt->execute();
    }
}
