<?php
require_once __DIR__ . '/../config/database.php';
require_once 'models/cartItem.php';
//entire shopping cart
class Cart
{
    private $db;
    private $items = [];

    public function __construct()
    {
        $this->db = new Database();  // Assuming a Database class for connection
        $this->loadItems();  // Load the cart items from the database
    }

    private function loadItems()
    {
        $sql = "SELECT * FROM cart";
        $result = $this->db->query($sql);

        while ($item = $result->fetch_assoc()) {
            $this->items[] = new CartItem($item['product_id'], $item['quantity']);
        }
    }

    public function addItem($product_id, $quantity)
    {
        // Check if the item is already in the cart
        foreach ($this->items as $item) {
            if ($item->getProductId() == $product_id) {
                // Increment the quantity locally and in the database
                $item->updateQuantity($quantity);
                $this->updateItemQuantityInDatabase($product_id, $quantity);  // Update database with new quantity
                return;
            }
        }

        // If item is not in the cart, add it locally and in the database
        $this->items[] = new CartItem($product_id, $quantity);
        $this->saveItem($product_id, $quantity);  // Save the new item in the database
    }

    private function updateItemQuantityInDatabase($product_id, $new_quantity)
    {
        // Add to the existing quantity in the database
        $sql = "UPDATE cart SET quantity = quantity + ? WHERE product_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $new_quantity, $product_id);
        $stmt->execute();
    }

    private function saveItem($product_id, $quantity)
    {
        $sql = "INSERT INTO cart (product_id, quantity) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $product_id, $quantity);
        $stmt->execute();
    }

    public function removeItem($product_id)
    {
        foreach ($this->items as $key => $item) {
            if ($item->getProductId() == $product_id) {
                unset($this->items[$key]);
                break;
            }
        }

        $sql = "DELETE FROM cart WHERE product_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
    }

    public function getItems()
    {
        return $this->items;
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getTotalPrice();
        }
        return $total;
    }

    public function clearCart()
    {
        $sql = "DELETE FROM cart";
        $this->db->query($sql);
        $this->items = [];
    }
}
