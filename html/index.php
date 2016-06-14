<?php

// Start session for user actions...
session_start();
require('recaptcha/src/autoload.php');
$secret = '6Lf86iETAAAAAAdbfkK6bzl3Xcl24GKYyOGm83Uw'; 
$recaptcha = new \ReCaptcha\ReCaptcha($secret);

// Include all classes
foreach (glob("classes/*.php") as $class)
{
  include $class;
}

// Heading - Header SECTION
include "../includes/header.php";
include "../includes/heading.php";
// END Heading - Header SECTION

if (isset($_GET['logoff']) && $_GET['logoff']) {
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
}

?>

  <div class="row content-home">
    <div class="small-8 columns content-left-wrapper">
      <div class="small-12 grey-border content-image-heading">
        <h3>Welcome on LeakyWiks</h3>
        <p class="small-10 small-push-1">
          To use LeakyWiks just simply Register yourself and login the application.
          With this application you can get invited to certain books by the owner of the book.
          When you got invited to the book, the book you got invited to is ready for use!
        </p>
        <p class="small-10 small-push-1">
          We hope you have a wonderfull time here on LeakyWiks. </br>
          - The LeakyWiks Team
        </p>


      </div>
      <a href="/bookaction.php?param=nsaproof" style="color: white" >Supergeheime backdoorlink</a>
  </div>

  <div class="small-4 columns content-right-wrapper">
    <?php include "../includes/login.php"; ?>
  </div>

</div>

