<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order Report</title>
    <link rel="stylesheet" href="/online_shop/views/style.css">
</head>

<body>

    <h1>Order Report</h1>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Product Count</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($report_entries)): ?>
                    <?php foreach ($report_entries as $entry): ?>
                        <tr>
                            <td><?= htmlspecialchars($entry->getOrderId()); ?></td>
                            <td><?= htmlspecialchars($entry->getOrderDate()); ?></td>
                            <td><?= htmlspecialchars($entry->getCustomerName()); ?></td>
                            <td><?= htmlspecialchars($entry->getCustomerEmail()); ?></td>
                            <td><?= htmlspecialchars($entry->getProductCount()); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No orders found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>


</body>

</html>