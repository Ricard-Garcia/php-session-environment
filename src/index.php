<?php
session_start();

// Login error
if (isset($_SESSION["loginError"])){
  $infoLogin = $_SESSION["loginError"];
};

// Logout message
if (isset($_GET["logout"])){
  if ($_GET["logout"]){
    $infoLogout = "You've logged out correctly.";
  }
}

// Not accessible area
if (isset($_SESSION["unabledAccess"])){
  $infoAccess = $_SESSION["unabledAccess"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Dependencies -->
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <title>Login PHP</title>
    <!-- Custom styles for this template -->
    <link href="./assets/styles/signin.css" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/sign-in/">
    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
</head>
<body>
    <form method="POST" action="./modules/login.php" class="form-signin">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="pass" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <?php
        // Adding loginError only if email/password are wrong
        if (isset($infoLogin)){
          echo "<div class='alert alert-warning' role='alert'>";
          echo $infoLogin;
          echo "</div>";
        }
        // Adding loginError only if email/password are wrong
        elseif (isset($infoLogout)){
          echo "<div class='alert alert-info' role='alert'>";
          echo $infoLogout;
          echo "</div>";
        }
        // Adding loginError only if email/password are wrong
        elseif (isset($infoAccess)){
          echo "<div class='alert alert-danger' role='alert'>";
          echo $infoAccess;
          echo "</div>";
        };
        ?>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
</body>
</html>