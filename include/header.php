
<header>
    <h1>Souk Search System</h1>
</header>

<div class="user-info">
    <div class="left">
        <p>Welcome, <strong><?php echo $_SESSION['USERNAME'] ?? 'Guest'; ?></strong> 
        Role: <strong><?php echo $_SESSION['ROLE'] ?? 'Unknown'; ?></p></strong>
    </div>
    <div class="right">
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</div>
