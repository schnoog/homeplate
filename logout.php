<?php
session_start();
session_destroy();
setcookie("remember_me", '', time() - 3600, "/", "", true, true); 
// Redirect to the login page:
header('Location: index.php');
?>