<?php
// Starting the session
session_start();

// Received inputs
$email = $_POST["email"];
$pass = $_POST["pass"];

// Database data
$emailDb = "hello@gmail.com";
$passDb = "123456";
$passHashDb = password_hash($passDb, PASSWORD_DEFAULT);

// Check if everything is correct
if (password_verify($pass, $passHashDb) && $email == $emailDb){
    // Setting session variables
    $_SESSION["username"] = $email;
    header("Location:../panel.php");
} else {
    echo "Not valid email and/or password";
    //header("Location:../index.php");

}
