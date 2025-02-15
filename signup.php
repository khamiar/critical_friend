<?php

session_start(); 


if (isset($_POST["submit"])) {
    include("include/db_connection.php");

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = ($_POST["password"]); 
    $confirm_password = $_POST["confirm_password"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];


    if ($password !== $confirm_password) {
        header("location:signup.php?sms=Error: Passwords do not match to confirm Password.");
        
    }

    $hashed_password = sha1($password);
    //echo ($hashed_password);

    $customer_qstr = "INSERT INTO customers (username, email, password, address, phone) 
        VALUES ('$username', '$email', '$password', '$address', '$phone')";
    mysqli_query($conn, $customer_qstr) or die("Customer registration failed");

    $user_qstr = "INSERT INTO users (username, email, password, role) 
        VALUES ('$username', '$email', '$password', 'customer')";
    mysqli_query($conn, $user_qstr) or die("User registration failed");
    header("location:index.php?sms=User Registered Successfully");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/login.css">
    <script>
        function validateSignup(){
            var name = document.getElementById("name");
            var email = document.getElementById("email");
            var address = document.getElementById("address");
            var phone = document.getElementById("phone");
            var password = document.getElementById("password");
            var confirm_password = document.getElementById("confirm_password");
            if(name.value == "" || email.value=="" || address.value=="" || phone.value == "" || password.value == "" || confirm_password.value == ""){
                alert("All field are required... Try Again");
                return false;
            }

            if(email.indexof("@") == -1 || email.indexof(".") == -1){
                alert("not valid email");
                return false;
            }
            
            if(password.lengh < 4){
                alert("password must have atleast 4 character");
                return false;
            }else{
                return true
            }
        }
    </script>
</head>
<body>
    
    <div class="signup-container">
        <h2>Sign Up</h2>
        <?php if(isset($_GET["sms"]))
			{
			?>
			<p style="color:red; text-align:center">
					<?php echo $_GET["sms"] ?>
			</p>
			
			<?php
			}
			?>
        <form onSubmit="return validateSignup()" action="signup.php" method="POST">
            <div class="input-group">
                <label for="name">Full Name</label>
                <input type="text" name="username" id="name" placeholder="Enter full name" >
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter email" >
            </div>
            <div class="input-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" placeholder="Enter address" >
            </div>
            <div class="input-group">
                <label for="phone">Phone Number</label>
                <input type="number" name="phone" id="phone" placeholder="Enter phone number" >
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter password" >
            </div>
            <div class="input-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" required>
            </div>
            <button  type="submit" name="submit" class="signup-btn">Sign Up</button>
        </form>
        <div class="register-link">
            Already have an account? <a href="login.php">Login</a>
        </div>
    </div>

</body>
</html>
