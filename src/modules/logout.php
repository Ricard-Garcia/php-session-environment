<?php
session_start();

// Eliminar totes les variables de sessió
unset($_SESSION);

// Eliminar cookies
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Eliminar sessió
session_destroy();

header("Location:../index.php");