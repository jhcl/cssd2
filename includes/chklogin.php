<?php 
  session_start();

  // Include all classes
  foreach (glob("classes/*.php") as $class)
  {
    include $class;
  }

  // Make database Object
  $db = new Database();
  $user = new User(null, null, null, null);

  $username = htmlentities($_POST['username']);
  $password = htmlentities($_POST['password']);

    // IF Captcha is succesfully entered than the user can either login or register
  if (isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response']) {
      $sec = "6Lf86iETAAAAAAdbfkK6bzl3Xcl24GKYyOGm83Uw";
      $ip = filter_var($_SERVER['REMOTE_ADDR'],FILTER_VALIDATE_IP);
      $captcha = $_POST['g-recaptcha-response'];
      $resp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$sec&response=$captcha&remoteip=$ip");
      $arr = json_decode($resp, TRUE);
      if ($arr['success']) {
          if ($_POST['submit'] == 'login') {
            $user->login($username, $password);
          }
          else if ($_POST['submit'] == 'register') {
            $user->register($username, $password);
          }
      } else {
          $_SESSION['msg'] = "Invalid captcha response";
          header('Location: /index.php');
      }
  } else {
      header('Location: /index.php');
  }
?>
