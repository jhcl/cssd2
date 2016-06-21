<?php
session_start();
require_once "../includes/dbconn.php";
$max_file_size = 26000000;

/**
 * Upload Functionality
 *
 * Only PDFS are allowed else this function will fail and so is the file upload, there is a check on this
 * Uploaded files will be set in map: /var/www/uploads/
 * File can't be bigger than the max file size or upload will fail
 *
 * If file is uploaded add additional file information in the database for the file
 */
if (!isset($_FILES["filename"]["error"])) {
    $_SESSION['msg'] =  "Upload failed.";
} else if ($_FILES["filename"]["error"] !== UPLOAD_ERR_OK) {
    $_SESSION['msg'] =  "Upload failed.";
    die("Upload failed " . $_FILES["filename"]["error"]);
} else {
    if(isset($_POST['fupload'])) {
        if (mime_content_type($_FILES['filename']['tmp_name']) === "application/pdf") {
            $uploaddir = "/var/www/uploads/";
            $fufile = $uploaddir . uniqid($_SESSION['user'], TRUE);
            $size = filesize($_FILES['filename']['tmp_name']);
            if($size !== false) {
                if ($size > $max_file_size ) {
                    $_SESSION['msg'] = "File too large.";
                } else {
                    echo "Location " . $fufile . " ,size " . number_format($size/1024,2) . " kB<br>";
                }
            } else {
                die("Filesize check failed.");
            }
        } else {
            $_SESSION['msg'] = "Only PDFs allowed";
            header('location:/hoofdpagina.php');
            exit();
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
}
header('location:/hoofdpagina.php');
?>

