<?php
use musicBands\Band;
include("Band.php");

$fileName = $_POST["fileSave"];
Band::saveFromFile($fileName);
?>

<html>
<?php include("header.php") ?>
<body>
    <?php include("navbar.php") ?>
    <div class="alert alert-success m-5 p-5" role="alert">Data added to DB.</div>
</body>
</html>
