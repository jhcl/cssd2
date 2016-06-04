<?php
session_start();
require_once('classes/Database.php');
$db = new Database();

switch ($_POST['bookaction']) {
case 'delete': 
    if ($db->deleteStatement("delete from user_bestandid where bestandid = :id" , array("id"=>$_POST['bestandid'])) &&
        $db->deleteStatement("delete from bestand where id = :id" , array("id"=>$_POST['bestandid']))) {
            unlink(addslashes($_POST['bestandloc']));
        }
    break;
case 'share': 
    $db->insertStatement("insert into user_bestandid (username, bestandid) values (:user, :bestandid)",
        array("user"=>$_POST['username'], "bestandid"=>$_POST['bestandid']));
    break;
case 'addComment': 
    $db->insertStatement("insert into comment (username, date, fileid, comment) values (:user, :date, :fileid, :comment)", 
        array("user"=>$_SESSION['user'], "date"=>date("Y-m-d H:i:s"), "fileid"=>$_POST['fileid'], "comment"=>$_POST['commentArea']));
    break;
}
header("Location: /hoofdpagina.php");
?>
