<?php
include('include/session.php');
include ('include/db_connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Souk Product Report</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php include 'include/header.php'; ?>

<main>
    <?php include 'include/sidenav.php'; ?>
    <div class="content">
        <h1 class="text-end">Customer Report</h1>
        <?php
        $jumbi_query = "SELECT COUNT(*) FROM jumbi_products";
        $query = mysqli_query($conn, $jumbi_query) or die(mysqli_error());
        
        $jumbi_count = 0;
       
        while ($row = mysqli_fetch_array($query)){
            $jumbi_count = $row[0];
        }

        $kwer_query = "SELECT COUNT(*) FROM jumbi_products";
        $query = mysqli_query($conn, $kwer_query) or die(mysqli_error());

        $kwerekwe_count = 0;

        while ($row = mysqli_fetch_array($query)){
            $kwerekwe_count = $row[0];
        }
        ?>
        <div class="card text-white bg-primary mb-3">
            <div class="card header bg-success"><h4>Jumbi Souk</h4></div>
            <div class="card-body">
                <h5 class="cart-title">Total Product</h5>
                <p class="card-text">Total Product in Kwerekwe Souk is: <?php echo $jumbi_count ?></p>
            </div>
        </div>

        <div class="card text-white bg-success mb-3">
            <div class="card header bg-primary"><h4>Kwerekwe Souk</h4></div>
            <div class="card-body">
                <h5 class="cart-title">Total Product</h5>
                <p class="card-text">Total Product in Kwerekwe Souk is: <?php echo $kwerekwe_count ?></p>
            </div>
        </div>
    </div>
</main>
<?php include 'include/footer.php'; ?>
</body>
</html>
