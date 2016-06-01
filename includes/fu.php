<?php
if ($_FILES["filename"]["error"] !== UPLOAD_ERR_OK) {
   die("Upload failed " . $_FILES["filename"]["error"]);
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
} else {
    echo "Upload failed";
    $_SESSION['msg'] =  "Upload failed";
}
?>

