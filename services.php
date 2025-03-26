<?php
require_once("connection.php");

// Fetch products from the database
$result = $conn->query("SELECT * FROM products ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<?php include("includes/head.php"); ?>
<body>
    <div class="wrapper">
        <?php include("includes/navigation-bar.php"); ?>

        <div id="body" class="active">
            <?php include("includes/navbar.php"); ?>

            <div class="content p-4">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3>Products</h3>
                        <a href="add_product.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add Product</a>
                    </div>

                    <div class="row">
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <img src="uploads/<?php echo $row['image']; ?>" class="card-img-top" height="200">
                                    <div class="card-body text-center">
                                        <h5 class="card-title"><?php echo htmlspecialchars($row['image_name']); ?></h5>
                                        <p class="card-text"><?php echo htmlspecialchars($row['image_description']); ?></p>
                                        <a href="add_product.php?edit=<?php echo $row['image_name']; ?>" class="btn btn-warning">Edit</a>
                                        <a href="delete_product.php?name=<?php echo $row['image_name']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("includes/script.php"); ?>
</body>
</html>
