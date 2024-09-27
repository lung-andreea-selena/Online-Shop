<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <link rel="stylesheet" href="/online_shop/views/style.css">
</head>

<body>

    <h1>Your Cart</h1>

    <?php if (!empty($cart->getItems())): ?>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart->getItems() as $index => $item): ?>
                    <tr>
                        <td><?= $index + 1; ?></td>
                        <td><?= htmlspecialchars($item->getProductName()); ?></td>
                        <td><?= htmlspecialchars($item->getQuantity()); ?></td>
                        <td><?= htmlspecialchars($item->getPriceWithVAT()); ?> ron</td>
                        <td><?= htmlspecialchars($item->getTotalPrice()); ?> ron</td>
                        <td>
                            <a href="/online_shop/index.php?controller=cart&action=removeFromCart&product_id=<?= $item->getProductId(); ?>">Remove</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3>Total: <?= htmlspecialchars($cart->getTotal()); ?> ron</h3>
        <button onclick="window.location.href='/online_shop/index.php?controller=order&action=checkout'">Proceed to Checkout</button>

    <?php else: ?>
        <p>Your cart is empty!</p>
    <?php endif; ?>

    <button onclick="window.location.href='index.php'">Back to Products</button>

</body>

</html>