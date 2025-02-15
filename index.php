<?php
session_start();
if(isset($_POST["submit"])){
    include("include/db_connection.php");

    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $pass = mysqli_real_escape_string($conn, $_POST["password"]);

    // FIXED: Corrected variable name from $user to $username
    $query_string = "SELECT * FROM users WHERE username ='$username' AND password='$pass'";

    $query = mysqli_query($conn, $query_string) or die("Error: " . mysqli_error($conn));
    $num = mysqli_num_rows($query);

    // FIXED: Corrected assignment `=` to comparison `==`
    if($num == 1){
        $row = mysqli_fetch_array($query);

        $_SESSION["USERNAME"] = $row["username"];  // Store username in session
        $_SESSION["ROLE"] = $row["role"];  // Store role in session

        header("location:home.php");
        exit();
    } else {
        header("location:index.php?msg=Wrong username or Password");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>
        <?php if(isset($_GET["msg"]))
			{
			?>
			<p style="color:red; text-align:center">
					<?php echo $_GET["msg"] ?>
			</p>
			
			<?php
			}
			?>
        <form action="login.php" method="POST">
            <div class="input-group">
                <label for="username">Full Name</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" name="submit" class="btnlogin">Login</button>

            <p class="login-link">Don't have an account? <a href="signup.php">Sign Up</a></p>
        </form>
    </div>

</body>
</html>
