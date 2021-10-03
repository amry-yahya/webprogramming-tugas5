<?php
session_start();
session_destroy();

$cookie_name = "cookie_username";
$cookie_value = "";
$time = time() - (3600);
setcookie($cookie_name, $cookie_value, $time, "/");

$cookie_name = "cookie_password";
$cookie_value = "";
$time = time() - (3600);
setcookie($cookie_name, $cookie_value, $time, "/");

header("location:index.php");
?>