<?php
require_once __DIR__ . '/../config/database.php';
require_once 'models/orderItem.php';

//order itself

class Order
{
    private $db;
    private $order_id;
    private $customer_name;
    private $customer_email;
    private $customer_phone;
    private $customer_address;
    private $total_amount;
    private $items = [];

    public function __construct($customer_name, $customer_email, $customer_phone, $customer_address, $total_amount)
    {
        $this->db = new Database();  // Assuming you have a Database class for connection
        $this->customer_name = $customer_name;
        $this->customer_email = $customer_email;
        $this->customer_phone = $customer_phone;
        $this->customer_address = $customer_address;
        $this->total_amount = $total_amount;
    }

    public function addItem(OrderItem $item)
    {
        $this->items[] = $item;  // Add order items to the list
    }

    public function save()
    {
        // Save the order to the database
        $sql = "INSERT INTO `order` (customer_name, customer_email, customer_phone, customer_address, total_amount) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssssi", $this->customer_name, $this->customer_email, $this->customer_phone, $this->customer_address, $this->total_amount);
        $stmt->execute();

        // Get the inserted order ID
        $this->order_id = $stmt->insert_id;

        // Save each order item
        foreach ($this->items as $item) {
            $item->save($this->order_id);  // Pass the order ID to each item to save them
        }
    }

    public function getId()
    {
        return $this->order_id;
    }
}
