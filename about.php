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
                    <div class="page-title">
                        <h3>About</h3>
                    </div>

                    <?php
                    require_once("connection.php");
                    $result = $conn->query("SELECT * FROM about ORDER BY created_at DESC LIMIT 1");

                    $aboutData = $result->fetch_assoc();
                    ?>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-dark text-white">Warner Robins Medical Clinic</div>
                                <div class="card-body">
                                    <form action="update-about.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo isset($aboutData['id']) ? $aboutData['id'] : ''; ?>">

                                        
                                        <!-- Image Upload Section -->
                                        <div class="card mb-3">
                                            <div class="card-header bg-primary text-white">Upload Image</div>
                                            <div class="card-body">
                                                <?php if (!empty($aboutData['image'])): ?>
                                                    <img src="uploads/<?php echo $aboutData['image']; ?>" width="300"><br>
                                                <?php endif; ?>
                                                <input type="file" name="image" class="form-control">
                                            </div>
                                        </div>

                                        <!-- Content Section -->
                                        <div class="card mb-3">
                                            <div class="card-header bg-success text-white">Add Content</div>
                                            <div class="card-body">
                                                <textarea class="form-control" name="content" rows="5" required><?php echo isset($aboutData['content']) ? trim(htmlspecialchars($aboutData['content'])) : ''; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="mb-3 text-center">
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                                            <button type="reset" class="btn btn-secondary"><i class="fas fa-times"></i> Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- End of Container -->
            </div> <!-- End of Content -->
        </div> <!-- End of Body -->
    </div> <!-- End of Wrapper -->

    <?php include("includes/script.php"); ?>
</body>

</html>
