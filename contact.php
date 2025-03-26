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
                        <h3>Contact Information</h3>
                    </div>

                    <?php
                    require_once("connection.php");
                    $result = $conn->query("SELECT * FROM contact LIMIT 1");
                    $contactData = $result->fetch_assoc();
                    ?>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-dark text-white">Update Contact Details</div>
                                <div class="card-body">
                                    <form action="update_contact.php" method="POST">
                                        <div class="mb-3">
                                            <label class="form-label">Telephone</label>
                                            <input type="text" class="form-control" name="tel" value="<?php echo htmlspecialchars($contactData['tel'] ?? ''); ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Fax</label>
                                            <input type="text" class="form-control" name="fax" value="<?php echo htmlspecialchars($contactData['fax'] ?? ''); ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <textarea class="form-control" name="address" rows="3" required><?php echo htmlspecialchars($contactData['address'] ?? ''); ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($contactData['email'] ?? ''); ?>" required>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("includes/script.php"); ?>
</body>
</html>
