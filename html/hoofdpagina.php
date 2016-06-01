<?php
// Start session for user actions...
session_start();
// Heading - Header SECTION
include "../includes/header.php";
include "../includes/heading.php";
// END Heading - Header SECTION
?>
<form action="fuproxy.php" method="post" enctype="multipart/form-data">
    <input type="file" name="filename" id="filename"><br>
    <input type="submit" value="Upload" name="fupload">
</form>

