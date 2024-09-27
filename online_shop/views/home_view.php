<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> My shop</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".details-button").on("click", function() {
                var product_id = $(this).data("product_id");
                console.log("Product ID:", product_id); // Debug output to ensure product_id is working
                if (!product_id) {
                    console.log("Product ID is missing!");
                } else {
                    window.location.href = "/online_shop/index.php?controller=product&action=getProductById&product_id=" + product_id;
                }
            });
        });
    </script>
    <link rel="stylesheet" href="/online_shop/views/style.css">
</head>

<body>

    <button onclick="window.location.href='/online_shop/index.php?controller=cart&action=viewCart'">Go to Cart</button>
    <button onclick="window.location.href='/online_shop/index.php?controller=report&action=showReport'">Report</button>

    <h1>All Products</h1>
    </div>
    <div class="container">
        <table>
            <tr>
                <th>Title</th>
                <th>Price</th>
                <th>Categories</th>
                <th>Details</th>
            </tr>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product->getName()); ?></td>
                    <td>
                        <?php if ($product->getIfTva()): ?>
                            <?= htmlspecialchars($product->calculatePrice()); ?> ron (including 10% tva)
                        <?php else: ?>
                            <?= htmlspecialchars($product->calculatePrice()); ?> ron
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php foreach ($product->getCategories() as $category): ?>
                            <?= htmlspecialchars($category->getName()); ?><br>
                        <?php endforeach; ?>
                    </td>
                    <td><button class="details-button" data-product_id="<?= $product->getId(); ?>">View Details</button></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>


</body>

</html>