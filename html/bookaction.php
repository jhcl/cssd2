<?php
session_start();

require_once('classes/Database.php');
require_once('classes/User.php');
$db = new Database();
$usr = new User(null, $_SESSION['user'], null,null);

if (!isset($_SESSION['user']) || $_SESSION['user'] == '') {
    header('Location: /index.php');
}

switch ($_POST['bookaction']) {
case 'delete': 
    $id = $_POST['bestandid'];
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
    if ($usr->isOwner($_POST['bestandid'])) {
        $db->insertStatement("insert into user_bestandid (username, bestandid) values (:user, :bestandid, 1)",
            array("user"=>$_POST['username'], "bestandid"=>$_POST['bestandid']));
    } else {
        $_SESSION['msg'] = "Only owner can share this file.";
    }
    break;
case 'addComment': 
    if ($usr->isOwner($_POST['fileid']) || $usr->hasInvite($_POST['fileid'])) {
        $db->insertStatement("insert into comment (username, date, fileid, comment) values (:user, :date, :fileid, :comment)", 
            array("user"=>$_SESSION['user'], "date"=>date("Y-m-d H:i:s"), "fileid"=>$_POST['fileid'], "comment"=>$_POST['commentArea']));
    } else {
        $_SESSION['msg'] = "Only invited people can comment on this file.";
    }
    break;
case 'download': 
    if ($usr->isOwner($_POST['bestandid']) || $usr->hasInvite($_POST['bestandid'])) {
        $result = $db->selectStatement("select location,name from bestand where id = :id", array("id"=>$_POST['bestandid']));
        header('Content-type: ' . mime_content_type ($result[0]['location']));
        header('Content-Disposition: attachment; filename="' . $result[0]["name"] . '"');
        readfile($result[0]['location']);
    } else {
      $_SESSION['msg'] = "Not authorized";
    }
    exit;
case 'request': 
    if (!$usr->isOwner($_POST['bestandid']) && !$usr->hasRequested($_POST['bestandid'])) {
        $db->insertStatement("insert into user_bestandid (username, bestandid, invite) values (:user, :fileid, 0)", 
            array("user"=>$_SESSION['user'], "fileid"=>$_POST['bestandid']));
    } else {
      $_SESSION['msg'] = "Request error";
    }
    break;
case 'accept': 
    if ($usr->isOwner($_POST['bestandid'])) {
        $db->updateStatement("update user_bestandid set invite = 1 where bestandid = :fileid", 
            array("fileid"=>$_POST['bestandid']));
    } else {
      $_SESSION['msg'] = "Accept error";
    }
}
header("Location: /hoofdpagina.php");
?>
