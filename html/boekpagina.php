<?php
    require_once('classes/Database.php');

// Heading - Header SECTION
    include "../includes/header.php";
    include "../includes/heading.php";
// END Heading - Header SECTION

    $db = new Database();
    if (isset($_GET['id'])) {
        $boekid = $_GET['id'];
    }
    $comments = $db->selectStatement("select * from comment where fileid = :id", array("id"=>$boekid));
//    echo "<pre>"; print_r($comments);echo "</pre>";
    foreach ($comments as $comm) {
        echo $comm['comment'] . " /  Author: " . $comm['username'];
    }
    echo '<form method="post" action="bookaction">';
    echo '<input type="hidden" value=' . $comm['fileid'] . "/>";
    echo '<textarea cols="2" rows="2" name="commentArea"></textarea>';
    echo '<input type="submit" value="submit" name="btnComment"/>';

?>
