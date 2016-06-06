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

  $username = $_POST['username'];
  $password = $_POST['password'];
     
  if (isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response']) {
      $sec = "6Lf86iETAAAAAAdbfkK6bzl3Xcl24GKYyOGm83Uw";
      $ip = $_SERVER['REMOTE_ADDR'];
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
      }
  }
?>
