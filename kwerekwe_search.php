<?php
include('include/session.php');
include 'include/db_connection.php'; // Ensure database connection is included at the beginning

// Check if the user is logged in
if (!isset($_SESSION['ROLE'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Souk Search System</title>
    <link rel="stylesheet" href="css/styles.css"> 
</head>
<body>

<?php include 'include/header.php'; ?>

<main>
    <?php include 'include/sidenav.php'; ?>

    <div class="content">
        <h2>Search for Products</h2>
        <form method="GET" action="kwerekwe_search.php">
            <input type="text" name="query" placeholder="Search products...">
            <button type="submit">Search</button>
        </form>

        <div class="product-list">
            <?php
            // Ensure database connection is valid
            if (!$conn) {
                die("Database Connection Failed: " . mysqli_connect_error());
            }

            // Get the search query from URL or set empty if not provided
            $searchQuery = isset($_GET['query']) ? trim($_GET['query']) : '';

            // Correct table name `jumbi_products`
            $sql = "SELECT * FROM kwerekwe_products WHERE name LIKE ? OR description LIKE ?";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $searchTerm = "%$searchQuery%";
                $stmt->bind_param("ss", $searchTerm, $searchTerm);
                $stmt->execute();
                $result = $stmt->get_result();
            } else {
                die("SQL Error: " . $conn->error);
            }
            ?>

            <div class="product-list">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="product-card">
                        <img src="uploads/<?= htmlspecialchars($row['image']) ?>" width='10px' alt="<?= htmlspecialchars($row['name']) ?> ">
                            <h3>Name: <?= htmlspecialchars($row['name']) ?></h3>
                            <p>Price: <?= htmlspecialchars($row['price']) ?> TZS</p>
                            <p>Description: <?= htmlspecialchars($row['description']) ?></p>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No products found matching "<strong><?= htmlspecialchars($searchQuery) ?></strong>".</p>
                <?php endif; ?>
            </div>

        </div>
    </div>
</main>

<?php include 'include/footer.php'; ?>

</body>
</html>
