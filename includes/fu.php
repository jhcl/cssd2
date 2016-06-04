<?php
session_start();
require_once "../includes/dbconn.php";

if ($_FILES["filename"]["error"] !== UPLOAD_ERR_OK) {
   die("-Upload failed " . $_FILES["filename"]["error"]);
}
$uploaddir = "/var/www/uploads/";
$fufile = $uploaddir . basename($_FILES['filename']['name']);

if(isset($_POST['fupload'])) {
    $size = filesize($_FILES['filename']['tmp_name']);
    if($size !== false) {
        echo "Location " . $fufile . " ,size " . number_format($size/1024,2) . " kB<br>";
    } else {
        die("Filesize check failed.");
    }
}

if (move_uploaded_file($_FILES["filename"]["tmp_name"], $fufile)) {
    echo basename( $_FILES["filename"]["name"]) . " uploaded.";
    $query = "insert into bestand (name, location, owner) values (:nm, :loc, :own)";
    $sth = $dbh->prepare($query);
    $sth->bindParam(':nm', $_FILES['filename']['name']);
    $sth->bindParam(':loc', $fufile);
    $sth->bindParam(':own', $_SESSION['user']);
    $sth->execute();
    $_SESSION['msg'] =  "File uploaded";
} else {
    $_SESSION['msg'] =  "Upload failed";
}
header('location:/hoofdpagina.php');
?>

