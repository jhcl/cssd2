<?php
    session_start();

// Heading - Header SECTION
    include "../includes/header.php";
    include "../includes/heading.php";
// END Heading - Header SECTION

    require_once('classes/Database.php');
    require_once('classes/User.php');
    $db = new Database();
    $usr = new User(null, $_SESSION['user'], null, null);

    if (isset($_POST['fileid'])) {
//        if ($_POST['post_comment_token'] === $_SESSION['post_comment_token']) {
            $fid = intval($_POST['fileid']);
            if ($usr->hasInvite($fid) || $usr->isOwner($fid)) {
                if (isset($_POST['bookaction'])) {
                    $db->insertStatement("insert into comment (username, date, fileid, comment) values (:user, :date, :fileid, :comment)", 
                        array("user"=>$_SESSION['user'], "date"=>date("Y-m-d H:i:s"), "fileid"=>$fid, "comment"=>htmlentities($_POST['commentArea'])));
                }
            }
            else {
                header('Location: /hoofdpagina.php');
            }
//        }
    }

    if (isset($_GET['id'])) {
        $boekid = intval($_GET['id']);
        if ($usr->hasInvite($boekid) || $usr->isOwner($boekid)) {
            $comments = $db->selectStatement("select * from comment where fileid = :id", array("id"=>$boekid));
//          echo "<pre>"; print_r($comments);echo "</pre>";
            foreach ($comments as $comm) {
                echo $comm['comment'] . " /  Author: " . $comm['username'] . " / " . $comm['date'] . "<br>";
            }
            $_SESSION['post_comment_token'] = base64_encode( openssl_random_pseudo_bytes(32));
            echo '<form method="post" action="">';
            echo '<input type="hidden" name="fileid" value="' . $boekid . '" />';
            echo '<input type="hidden" name="post_comment_token" value="' . $_SESSION['post_comment_token'] . '" />';
            echo '<textarea cols="2" rows="2" name="commentArea"></textarea>';
            echo '<input type="submit" value="addComment" name="bookaction"/>';
            echo '</form>';
        }
        else {
            header('Location: /hoofdpagina.php');
        }
    }

?>
