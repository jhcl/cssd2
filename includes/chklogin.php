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
     
  if ($_POST['submit'] == 'login') {
    $user->login($username, $password);
  }
  else if ($_POST['submit'] == 'register') {
    $user->register($username, $password);
  }
?>
