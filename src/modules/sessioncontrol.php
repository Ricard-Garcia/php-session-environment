<?php

// Destroy session
function destroySession()
{
    // Start session
    session_start();

    // Unset all session variables
    unset($_SESSION);

    // Delete cookies
    deleteCookies();

    // Delete session
    session_destroy();

    // Redirect with query param
    header("Location:../index.php?logout=true");
}

// Delete cookies
function deleteCookies()
{
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
}
