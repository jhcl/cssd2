<?php 
  session_start();
  include "../includes/dbconn.php";

  $username = $_POST['username'];
  $password = $_POST['password'];
     
  if ($_POST['submit'] == 'login') {
    $query = "select * from gebruiker where username = :usr and password = :pwd";
    $sth = $dbh->prepare($query);
    $sth->bindParam(':usr', $username);
    $sth->bindParam(':pwd', $password);
    $sth->execute();
    if ($sth->rowCount() == 0) {
      $_SESSION['msg'] = "Invalid name or password for".$username."/".$password;
      header('Location:/index.php'); 
    }
    else {
      $row = $sth->fetch();
      $username = $row['username'];
      $password = $row['password'];
      $_SESSION['msg'] = "logged in as ".$username;
      setcookie("user", $username, time()+3600, "/");
      header('Location:/index.php');
    }
  }
  else if ($_POST['submit'] == 'register') {
    $query = "insert into gebruiker values (:usr, :pwd,'',1)";
    $sth = $dbh->prepare($query);
    $sth->bindParam(':usr', $username);
    $sth->bindParam(':pwd', $password);
    $sth->execute();
    $_SESSION['msg'] = "Registered ".$username." ".$password;
    header('Location:/index.php'); 
  }
?>
