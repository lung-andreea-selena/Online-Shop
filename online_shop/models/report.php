<?php
require_once __DIR__ . '/../config/database.php';
class Report
{
    private $order_id;
    private $order_date;
    private $customer_name;
    private $customer_email;
    private $product_count;

    public function __construct($order_id, $order_date, $customer_name, $customer_email, $product_count)
    {
        $this->order_id = $order_id;
        $this->order_date = $order_date;
        $this->customer_name = $customer_name;
        $this->customer_email = $customer_email;
        $this->product_count = $product_count;
    }

    public function getOrderId()
    {
        return $this->order_id;
    }

    public function getOrderDate()
    {
        return $this->order_date;
    }

    public function getCustomerName()
    {
        return $this->customer_name;
    }

    public function getCustomerEmail()
    {
        return $this->customer_email;
    }

    public function getProductCount()
    {
        return $this->product_count;
    }

    public static function fetchReportData()
    {
        $db = new Database();  // Assuming you have a Database class for connection
        $sql = "SELECT 
                    o.order_id AS order_id, 
                    o.created_at AS order_date, 
                    o.customer_name, 
                    o.customer_email, 
                    COUNT(oi.order_items_id) AS product_count
                FROM 
                    `order` o
                JOIN 
                    order_items oi ON o.order_id = oi.order_id
                JOIN 
                    product p ON oi.product_id = p.product_id
                JOIN 
                    product_categories pc ON p.product_id = pc.product_id
                JOIN 
                    (SELECT 
                        category_id 
                     FROM 
                        product_categories 
                     GROUP BY 
                        category_id 
                     HAVING COUNT(product_id) > 3) AS popular_categories 
                     ON pc.category_id = popular_categories.category_id
                WHERE 
                    p.product_price < 100
                GROUP BY 
                    o.order_id
                ORDER BY 
                    product_count DESC";

        $result = $db->query($sql);
        $report_entries = [];

        while ($row = $result->fetch_assoc()) {
            $report_entries[] = new Report(
                $row['order_id'],
                $row['order_date'],
                $row['customer_name'],
                $row['customer_email'],
                $row['product_count']
            );
        }

        return $report_entries;
    }
}
