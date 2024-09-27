<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Product Details</title>
    <link rel="stylesheet" href="/online_shop/views/style.css">
</head>

<body>

    <h1>Product Details</h1>
    <div id="product-details">
        <?php if ($product): ?>
            <p><strong>Title:</strong> <?= htmlspecialchars($product->getName()); ?></p>
            <p><strong>Description:</strong> <?= htmlspecialchars($product->getDescription()); ?></p>
            <p><strong>Price:</strong> <?= htmlspecialchars($product->calculatePrice()); ?> ron</p>
            <p><strong>Categories:</strong>
                <?php foreach ($product->getCategories() as $category): ?>
                    <?= htmlspecialchars($category->getName()); ?><br>
                <?php endforeach; ?>
            </p>
        <?php else: ?>
            <p>Product not found!</p>
        <?php endif; ?>
    </div>


    <form id="add-to-cart-form" method="POST" action="/online_shop/index.php?controller=cart&action=addToCart">
        <input type="hidden" name="product_id" value="<?= htmlspecialchars($product->getId()); ?>">

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="1" min="1" style="width: 50px;">

        <button type="submit">Add to Cart</button>
    </form>


    <button onclick="window.location.href='index.php'">Back to Products</button>

</body>

</html>