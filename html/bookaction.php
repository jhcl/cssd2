<?php
require_once('classes/Database.php');
$db = new Database();

switch ($_POST['bookaction']) {
case 'delete': 
    $db->deleteStatement("delete from bestand where id = :id" , array("id"=>$_POST['bestandid']));
    unlink(addslashes($_POST['bestandloc']));
    break;
case 'share': 
    echo "share boek " . $_POST['bestandid'];
    break;
}
header("Location: /hoofdpagina.php");
?>
