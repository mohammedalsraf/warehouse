<?php

session_start(); // Start the session

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to the login page or any other page as needed
header("Location: ../index.php");
exit();





?>