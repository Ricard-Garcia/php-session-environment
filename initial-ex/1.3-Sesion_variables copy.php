<?php
// Starting the session
session_start();

// Session variables
$_SESSION['browser'] = $_SERVER['HTTP_USER_AGENT'];
$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
$_SESSION['time'] = time();

// Renderig the variables
echo "<pre>", print_r($_SESSION), "</pre>";
