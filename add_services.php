<?php
require_once("connection.php");


$services = ['image' => '', 'image_name' => ''];
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM services WHERE image_name='$id'");
    $services = $result->fetch_assoc();
}
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
                    <h3><?php echo isset($_GET['edit']) ? "Edit services" : "Add Services"; ?></h3>

                    <form action="update_services.php" method="POST" enctype="multipart/form-data">
                        <div class="card mb-3">
                            <div class="card-header bg-primary text-white">Services Image</div>
                            <div class="card-body">
                                <?php if (!empty($product['image'])): ?>
                                    <img src="uploads/<?php echo $services['image']; ?>" width="200"><br>
                                <?php endif; ?>
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header bg-success text-white">service Name</div>
                            <div class="card-body">
                                <input type="text" name="image_name" class="form-control" value="<?php echo htmlspecialchars($services['image_name']); ?>" required>
                            </div>
                        </div>

  
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                            <a href="services.php" class="btn btn-secondary"><i class="fas fa-times"></i> Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include("includes/script.php"); ?>
</body>
</html>
