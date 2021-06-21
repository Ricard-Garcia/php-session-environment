<?php
/* -------------------------------------------------------------------------- */
/*                                    LOGIN                                   */
/* -------------------------------------------------------------------------- */
function checkSession()
{
    // Start session
    session_start();

    // Get basename URI or Query param
    $urlFile = basename($_SERVER["REQUEST_URI"], "?" . $_SERVER["QUERY_STRING"]);

    if ($urlFile == "index.php" || $urlFile == "src") {
        // Redirect to index if user logged
        if (isset($_SESSION["email"])) {
            header("Location:./panel.php");
        } else {
            // Login error
            if ($alert = checkLoginError()) return $alert;
            // Login error
            if ($alert = checkLoginInfo()) return $alert;
            // Logout
            if ($alert = checkLogout()) return $alert;
        }
    } else {
        // Redirect if there's no email
        if (!isset($_SESSION["email"])) {
            echo "Not registered";
            // Message if there are no permissions
            $_SESSION["loginError"] = "You must log in to access this area.";
            header("Location:./index.php");
        }
    };
}

// Diferent possible errors
function checkLoginError()
{
    if (isset($_SESSION["loginError"])) {
        $errorText = $_SESSION["loginError"];
        unset($_SESSION["loginError"]);
        return ["type" => "warning", "text" => $errorText];
    }
}

function checkLoginInfo()
{
    if (isset($_SESSION["loginInfo"])) {
        $infoText = $_SESSION["loginInfo"];
        unset($_SESSION["loginInfo"]);
        return ["type" => "info", "text" => $infoText];
    }
}

function checkLogout()
{
    if (isset($_GET["logout"]) && !isset($_SESSION["email"])) return ["type" => "primary", "text" => "Logout succesful"];
}

function checkUser(string $email, string $pass)
{
    $emailDb = "ricard@gmail.com";
    $passDb = "123456";
    $passHashDb = password_hash($passDb, PASSWORD_DEFAULT);

    if ($email == $emailDb && password_verify($pass, $passHashDb)) {
        return true;
    } else {
        return false;
    }
}


function hasUser()
{
    // Start session
    session_start();

    $email = $_POST["email"];
    $user = explode("@", $_POST["email"])[0];
    $pass = $_POST["pass"];

    if (checkUser($email, $pass)) {
        $_SESSION["email"] = $email;
        $_SESSION["username"] = ucfirst($user);
        // Redirect to panel.php
        header("Location:../panel.php");
    } else {
        $_SESSION["loginError"] = "Wrong email or password.";
        // Redirect to index.php
        header("Location:../index.php");
    }
}

/* -------------------------------------------------------------------------- */
/*                                   LOGOUT                                   */
/* -------------------------------------------------------------------------- */

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
