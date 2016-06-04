<?php
    session_start();
    require_once('classes/Database.php');
    $db = new Database();

    if (isset($_POST['bookaction'])) {
        $db->insertStatement("insert into comment (username, date, fileid, comment) values (:user, :date, :fileid, :comment)", 
            array("user"=>$_SESSION['user'], "date"=>date("Y-m-d H:i:s"), "fileid"=>$_POST['fileid'], "comment"=>$_POST['commentArea']));
    }

// Heading - Header SECTION
    include "../includes/header.php";
    include "../includes/heading.php";
// END Heading - Header SECTION

    $db = new Database();
    if (isset($_GET['id'])) {
      $boekid = $_GET['id'];
      $comments = $db->selectStatement("select * from comment where fileid = :id", array("id"=>$boekid));
//    echo "<pre>"; print_r($comments);echo "</pre>";
      foreach ($comments as $comm) {
          echo $comm['comment'] . " /  Author: " . $comm['username'] . "<br>";
      }
      echo '<form method="post" action="">';
      echo '<input type="hidden" name="fileid" value="' . $boekid . '" />';
      echo '<textarea cols="2" rows="2" name="commentArea"></textarea>';
      echo '<input type="submit" value="addComment" name="bookaction"/>';
      echo '</form>';
    }

?>
