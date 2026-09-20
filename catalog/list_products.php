<?php include 'view/header.php'; ?>

<div class="container">
    <h1>Product Manager</h1>
    <hr>

    <h2>Category List</h2>
    <table>
        <tr>
            <th>Category</th>
        </tr>
        <?php foreach ($categories as $cat) : ?>
            <tr>
                <td>
                    <a href="index.php?action=list_products&amp;category_id=<?php echo $cat['categoryID']; ?>">
                        <?php echo htmlspecialchars($cat['categoryName']); ?>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php if (isset($category) && $category) : ?>
    <h2>Products for: <?php echo htmlspecialchars($category['categoryName']); ?></h2>

    <?php
    // Khai báo tất cả form UPDATE + DELETE bên ngoài table (HTML hợp lệ)
    foreach ($products as $product):
        $pid = $product['productID'];
    ?>
        <!-- Form Update cho product #<?php echo $pid; ?> -->
        <form id="update-<?php echo $pid; ?>" action="index.php" method="post">
            <input type="hidden" name="action"      value="update_product">
            <input type="hidden" name="product_id"  value="<?php echo $pid; ?>">
            <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
        </form>

        <!-- Form Delete cho product #<?php echo $pid; ?> -->
        <form id="delete-<?php echo $pid; ?>" action="index.php" method="post">
            <input type="hidden" name="action"      value="delete_product">
            <input type="hidden" name="product_id"  value="<?php echo $pid; ?>">
            <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
        </form>
    <?php endforeach; ?>

    <table>
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th class="right">Price</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        <?php foreach ($products as $product) : $pid = $product['productID']; ?>
            <tr>
                <td>
                    <!-- form="update-{id}" liên kết input với form bên ngoài table -->
                    <input type="text" name="code"
                           form="update-<?php echo $pid; ?>"
                           value="<?php echo htmlspecialchars($product['productCode']); ?>"
                           class="inline-input">
                </td>
                <td>
                    <input type="text" name="name"
                           form="update-<?php echo $pid; ?>"
                           value="<?php echo htmlspecialchars($product['productName']); ?>"
                           class="inline-input wide">
                </td>
                <td class="right">
                    <input type="text" name="price"
                           form="update-<?php echo $pid; ?>"
                           value="<?php echo $product['listPrice']; ?>"
                           class="inline-input price">
                </td>
                <td>
                    <input type="submit"
                           form="update-<?php echo $pid; ?>"
                           value="Update"
                           class="btn-update">
                </td>
                <td>
                    <input type="submit"
                           form="delete-<?php echo $pid; ?>"
                           value="Delete"
                           class="btn-delete">
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>

    <h2>Add Product</h2>
    <form action="index.php" method="post">
        <input type="hidden" name="action"      value="add_product">
        <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
        <table>
            <tr>
                <td><label for="add_code">Code:</label></td>
                <td><input type="text" id="add_code" name="code" class="inline-input"></td>
            </tr>
            <tr>
                <td><label for="add_name">Name:</label></td>
                <td><input type="text" id="add_name" name="name" class="inline-input wide"></td>
            </tr>
            <tr>
                <td><label for="add_price">Price:</label></td>
                <td><input type="text" id="add_price" name="price" class="inline-input price"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Add Product"></td>
            </tr>
        </table>
    </form>

    <br>
    <p><a href="index.php">Add/Delete Categories</a></p>
    <hr>
</div>

<?php include 'view/footer.php'; ?>
