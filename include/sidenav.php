<div class="navigation">
    <h2>Menu</h2>
    <ul>
        <?php if(isset($_SESSION["ROLE"]) && $_SESSION["ROLE"] == "Admin"){ ?>
            <li><a href="home.php">Home</a></li>
            <li><a href="jumbi_search.php">View Jumbi Products</a></li>
            <li><a href="kwerekwe_search.php">View Kwerekwe Products</a></li>
            <li><a href="jumbi_dashboard.php">Jumbi Dashboard</a></li>
            <li><a href="kwerekwe_dashboard.php">Kwerekwe Dashboard</a></li>
            <li><a href="view_customers.php">View Customers</a></li>
            <li><a href="souk_product_report.php">Souk Product Report</a></li>
        <?php } elseif(isset($_SESSION["ROLE"]) && $_SESSION["ROLE"] == "customer"){ ?>
            <li><a href="home.php">Home</a></li>
            <li><a href="jumbi_search.php">View Jumbi Products</a></li>
            <li><a href="kwerekwe_search.php">View Kwerekwe Products</a></li>
        <?php } ?>
        <li><a href="logout.php">Log Out</a></li>
    </ul>
</div>
