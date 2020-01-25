<?php
session_start();
if (isset($_SESSION["customer_no"]) || isset($_COOKIE["customer_no"])) {
	session_destroy();
    setcookie('customer_no"', '', time() - 3600, '/');
    header("Location:home.php");
}
?>