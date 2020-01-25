<?php
session_start();
if (isset($_SESSION["admin_email"]) || isset($_COOKIE['admin_email'])) {
    session_destroy();
    setcookie('admin_email', '', time() - 3600, '/');
    header("Location:admin_login.php");
}
?>
