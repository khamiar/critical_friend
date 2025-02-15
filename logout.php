<?php
session_start();
unset($_SESSION["USERNAME"]);
unset($_SESSION["ROLE"]);
session_destroy(); // Clear session
header("Location: login.php");
exit;
?>