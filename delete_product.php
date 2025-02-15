<?php
session_start();
include('include/db_connection.php'); // Include your database connection

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Retrieve the product to delete the image file
    $query = "SELECT image FROM jumbi_products WHERE id = $product_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);

        // Delete the image file if it exists
        $image_path = 'uploads/' . $product['image'];
        if (file_exists($image_path)) {
            unlink($image_path); // Delete the file from the server
        }

        // Delete the product record from the database
        $delete_query = "DELETE FROM jumbi_products WHERE id = $product_id";
        if (mysqli_query($conn, $delete_query)) {
            header("Location: jumbi_dashboard.php?sms=Product deleted successfully");
            exit;
        } else {
            header("Location: jumbi_dashboard.php?sms=Error deleting product");
            exit;
        }
    } else {
        header("Location: jumbi_dashboard.php?sms=Product not found");
        exit;
    }
} else {
    header("Location: jumbi_dashboard.php?sms=Invalid request");
    exit;
}
?>
