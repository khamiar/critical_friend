<?php
include('include/session.php');
include ('include/db_connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Report</title>
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
        $query_cstm = "SELECT * FROM customers";
        $query = mysqli_query($conn, $query_cstm) or die(mysqli_error());
        ?>
        <table class="table table-bordered mt-4">
            <thead class="table-black">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Password</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row = mysqli_fetch_array($query)){
                ?>
                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['username'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['address'] ?></td>
                    <td><?php echo $row['phone'] ?></td>
                    <td><?php echo $row['password'] ?></td>
                    <td><?php echo $row['created_at'] ?></td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Password</th>
                <th>Date</th>
            </tfoot>
        </table>
    </div>
</main>
<?php include 'include/footer.php'; ?>
</body>
</html>
