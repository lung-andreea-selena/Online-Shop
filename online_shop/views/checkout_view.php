<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="/online_shop/views/style.css">
</head>

<body>

    <h1>Checkout</h1>

    <form method="POST" action="/online_shop/index.php?controller=order&action=submitOrder">
        <label for="customer_name">Name:</label>
        <input type="text" id="customer_name" name="customer_name" required><br>

        <label for="customer_email">Email:</label>
        <input type="email" id="customer_email" name="customer_email" required><br>

        <label for="customer_phone">Phone:</label>
        <input type="text" id="customer_phone" name="customer_phone" required><br>

        <label for="customer_address">Address:</label>
        <textarea id="customer_address" name="customer_address" required></textarea><br>

        <h3>Total: <?= htmlspecialchars($cart->getTotal()); ?> ron</h3>
        <input type="hidden" name="total_amount" value="<?= htmlspecialchars($cart->getTotal()); ?>">

        <button type="submit">Submit Order</button>
    </form>
    <button onclick="window.location.href='index.php'">Cancel order</button>

</body>

</html>