<?php session_start() ?>
<?php include "../includes/header.php" ?>
<?php include "../includes/heading.php" ?>

<div id="registerForm">
  <?php
    include "../includes/login.php";
    include "../includes/dbconn.php";
    print_r(PDO::getAvailableDrivers());
    //  echo phpinfo();
    $sql = 'SELECT username, password FROM gebruiker';
    foreach ($dbh->query($sql) as $row) {
      print "<br>";
      print $row['username'] . "\t";
      print $row['password'];
    }
  ?>
</div>
