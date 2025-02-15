<?php
include('include/session.php');
include ('include/db_connection.php');
?>
<?php

if (isset($_POST["add"])) {
    include("include/db_connection.php");
    
    // Form data
    $name = $_POST["name"];
    $price = $_POST["price"];
    $description = $_POST["description"];

    // Handling image upload
    $image = $_FILES["image"]["name"];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);

    // Check if the file is an image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        // Move the uploaded image to the desired directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $product_qstr = "INSERT INTO jumbi_products (name, description, price, image) VALUES ('$name', '$description', '$price', '$image')";
            $query = mysqli_query($conn, $product_qstr) or die("Operation Failed");

            header("location:jumbi_dashboard.php?sms=Product Added Successfully");
        } else {
            header("location:jumbi_dashboard.php?sms=Sorry, there was an error uploading your file.");
        }
    } else {
        echo "File is not an image.";
    }
}

?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jumbi Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php include 'include/header.php'; ?>

<main>
    <?php include 'include/sidenav.php'; ?>
    <div class="content">
        <h1 class="text-end">Manage Jumbi Products</h1>

        <!-- Add Product Form -->
        <form action="jumbi_dashboard.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Product Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Price</label>
                <input type="number" name="price" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label>Image</label>
                <input type="file" name="image" class="form-control" >
            </div>
            <button type="submit" name="add" class="btn btn-primary">Add Product</button>
        </form>

        <!-- Display Products Table -->
        <?php 
            $query_str = "SELECT * FROM jumbi_products";
            $query = mysqli_query($conn, $query_str) or die(mysqli_error($conn));
        ?>
        <table id="product_table_id" class="table table-bordered table-hover mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>EDIT</th>
                    <th>DELETE</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo $row["name"]; ?></td>
                        <td><?php echo $row["description"]; ?></td>
                        <td><?php echo $row["price"]; ?> TZS</td>
                        <td><img src='uploads/<?php echo $row["image"]; ?>' width='50'></td>
                        <td>
                            <!-- Trigger Modal -->
                            <a href="javascript:void(0);" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editProductModal<?php echo $row["id"]; ?>">
                                Edit
                            </a>

                            <!-- Edit Product Modal -->
                            <div class="modal fade" id="editProductModal<?php echo $row["id"]; ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $row["id"]; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="edit_products.php" method="POST" enctype="multipart/form-data">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel<?php echo $row["id"]; ?>">Edit Product</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">

                                                <div class="mb-3">
                                                    <label>Product Name</label>
                                                    <input type="text" name="name" class="form-control" value="<?php echo $row["name"]; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Price</label>
                                                    <input type="number" name="price" class="form-control" value="<?php echo $row["price"]; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Description</label>
                                                    <textarea name="description" class="form-control" required><?php echo $row["description"]; ?></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Image</label>
                                                    <input type="file" name="image" class="form-control">
                                                    <small>Leave blank to keep the current image.</small>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" name="update" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="delete_product.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>

            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>EDIT</th>
                    <th>DELETE</th>
                </tr>
            </tfoot>
            <?php
            if (isset($_GET['sms'])) {
                echo '<div class="alert alert-info">' . htmlspecialchars($_GET['sms']) . '</div>';
            }
            ?>

        </table>
    </div>
</main>
<?php include 'include/footer.php'; ?>
</body>
</html>
