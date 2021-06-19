<?php
// Starting the session
session_start();

// Received inputs
$email = $_POST["email"];
$user = explode("@", $_POST["email"])[0];
echo $user;
$pass = $_POST["pass"];

// Database data
$emailDb = "ricard@gmail.com";
$passDb = "123456";
$passHashDb = password_hash($passDb, PASSWORD_DEFAULT);

// Check if everything is correct
if (password_verify($pass, $passHashDb) && $email == $emailDb){
    // Setting session variables
    $_SESSION["email"] = $email;
    $_SESSION["username"] = ucfirst($user);
    header("Location:../panel.php");
} else {
    $_SESSION["loginError"] = "Wrong email or password.";
    header("Location:../index.php");
}
