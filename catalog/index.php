<?php include 'view/header.php'; ?>

<div class="container">
    <h1>Product Manager</h1>
    <hr>

    <!-- Category List with Add/Delete -->
    <h2>Category List</h2>
    <table>
        <tr>
            <th>Name</th>
            <th></th>
        </tr>
        <?php foreach ($categories as $category) : ?>
            <tr>
                <td>
                    <a href="index.php?action=list_products&category_id=<?php echo $category['categoryID']; ?>">
                        <?php echo htmlspecialchars($category['categoryName']); ?>
                    </a>
                </td>
                <td>
                    <form action="index.php" method="post">
                        <input type="hidden" name="action" value="delete_category">
                        <input type="hidden" name="category_id" value="<?php echo $category['categoryID']; ?>">
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Add Category Form -->
    <h2>Add Category</h2>
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="add_category">
        <label>Name:</label>
        <input type="text" name="name">
        <input type="submit" value="Add">
    </form>

    <br>
    <p><a href="index.php?action=list_products&category_id=<?php echo isset($category_id) ? $category_id : 1; ?>">List Products</a></p>
    <hr>

    <!-- Product List for selected category -->
    <?php if (isset($category) && $category): ?>
    <h2>Products for: <?php echo htmlspecialchars($category['categoryName']); ?></h2>
    <table>
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th class="right">Price</th>
            <th></th>
        </tr>
        <?php foreach ($products as $product) : ?>
            <tr>
                <td><?php echo htmlspecialchars($product['productCode']); ?></td>
                <td><?php echo htmlspecialchars($product['productName']); ?></td>
                <td class="right"><?php echo '$' . number_format($product['listPrice'], 2); ?></td>
                <td>
                    <form action="index.php" method="post">
                        <input type="hidden" name="action" value="delete_product">
                        <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
                        <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Add Product Form -->
    <h2>Add Product</h2>
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="add_product">
        <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
        <label>Code:</label>
        <input type="text" name="code"><br>
        <label>Name:</label>
        <input type="text" name="name"><br>
        <label>Price:</label>
        <input type="text" name="price"><br>
        <input type="submit" value="Add Product">
    </form>
    <?php endif; ?>

</div>

<?php include 'view/footer.php'; ?>