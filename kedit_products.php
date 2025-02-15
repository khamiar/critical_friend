<?php
include('session.php');
include('include/db_connection.php');

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];

    // If a new image is uploaded
    if (!empty($image)) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image);

        // Upload the new image
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
           

            // Update the database with the new image
            $update_query = "UPDATE kwerekwe_products SET name='$name', price='$price', description='$description', image='$image' WHERE id=$id";
        } else {
            header("Location: kwerekwe_dashboard.php?sms=Error uploading image");
            exit;
        }
    } else {
        // Update without changing the image
        $update_query = "UPDATE kwerekwe_products SET name='$name', price='$price', description='$description' WHERE id=$id";
    }

    // Execute the update query
    if (mysqli_query($conn, $update_query)) {
        header("Location: kwerekwe_dashboard.php?sms=Product updated successfully");
    } else {
        header("Location: kwerekwe_dashboard.php?sms=Error updating product");
    }
    exit;
}
?>
