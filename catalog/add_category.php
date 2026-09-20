<?php include 'view/header.php'; ?>

<div class="container">
    <h1>Product Manager</h1>
    <hr>

    <h2>Category List</h2>
    <table>
        <tr>
            <th>Name</th>
            <th></th>
        </tr>
        <?php foreach ($categories as $cat) : ?>
            <tr>
                <td><?php echo htmlspecialchars($cat['categoryName']); ?></td>
                <td>
                    <form action="index.php" method="post">
                        <input type="hidden" name="action" value="delete_category">
                        <input type="hidden" name="category_id" value="<?php echo $cat['categoryID']; ?>">
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Add Category</h2>
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="add_category">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">
        <input type="submit" value="Add">
    </form>

    <br>
    <p><a href="index.php?action=list_products&amp;category_id=1">List Products</a></p>
    <hr>
</div>

<?php include 'view/footer.php'; ?>
