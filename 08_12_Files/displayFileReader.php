<?php 
include "fileReader.php";
?>

<html>

<head>
    <?php include("../common/header.php") ?>
</head>

<body>
    <?php include("navbar.php") ?>
    <div class="m-5">
        <form action="" method="POST">
            <input class="form-control" type="file" name="fileName">
            <button class="btn btn-secondary mt-3">Read</button>
        </form>
    </div>
    <?php
    if (isset($_POST["fileName"])) {
        AnyFile::openFile($_POST["fileName"])->readDataFromFile(); ?>
        
        <div class="m-5">
        <form method="post" action="saveFromFile.php">
        <button class="btn btn-secondary mt-3" type="submit">Save to Database</button>
        <input hidden name="fileSave" id="fileSave" value="<?= $_POST["fileName"] ?>">
    </form>
    </div> <?php
    } ?>
</body>

</html>