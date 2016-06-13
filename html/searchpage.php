<?php 
session_start();
include 'classes/Database.php';
include 'classes/User.php';

$zoek = htmlentities($_POST['zoek']);
$db = new Database();
$usr = new User(null, $_SESSION['user'], null, null);

$result = $db->selectStatement("select id, name, owner from bestand where upper(name) like upper(:zk)", array("zk"=>"%$zoek%"));
//print_r($result);
if (!empty($result)) {
    foreach($result as $value) {
        $link =  '<a href="boekpagina.php?id=' . $value['id'] . ' class="highlight bold"">' . $value['name'] . '</a>';
            echo '<form method="post" action="bookaction.php">';
            echo '<div class="small-12 grey-border-no-bottom item-wrapper columns">';
            echo '<p class="default-p small-8 columns in-item-p">';
            echo $link . ' by <a href="#" class="highlight author">Author: ' . $value['owner'] . '</a>';
            echo '<input type="hidden" name="bestandid" value=' . $value['id'] . ' />';
        if ($usr->hasInvite($value['id']) || $usr->isOwner($value['id'])) {
            echo '<input type="submit" name="bookaction" value="download" class="button round-button cta-button" />';
        } else if (!$usr->hasRequested($value['id'])) {
            echo '<input type="submit" name="bookaction" value="request" class="button round-button cta-button"  />';
        }
            echo '</p> </div> </form>';
    }
}
?>
