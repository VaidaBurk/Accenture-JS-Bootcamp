<?php
$filename = $_POST["fileSave"];
$file = fopen($filename, "r");
if ($file == false) {
    exit();
}

$hostname = "localhost";
$username = "root";
$password = "";
$databasename = "js_bootcamp";
    
$connection = new mysqli($hostname, $username, $password, $databasename);
    
$errorMessage = "";
    
if ($connection->connect_error) {
$errorMessage = $connection->connect_error;
}

$scvContentLineArr = fgetcsv($file, filesize($filename), ",");

while ($csvContentLineArr = fgetcsv($file, filesize($filename), ",")){
    $firstName = $csvContentLineArr[0];
    $lastName = $csvContentLineArr[1];
    $email = $csvContentLineArr[2];
    $phoneNumber = $csvContentLineArr[3];

    $querry = "INSERT INTO customers (firstname, lastname, email, phone)
    VALUES ('$firstName','$lastName', '$email','$phoneNumber')";
    if ($connection->query($querry)) {
        $success = "Data succesfully added."; 
    } else {
        $errorMessage = $connection->error;
    }
}
?>

<html>
    <?php include("header.php") ?>
<body>
    <div class="container p-3">
        <?php if ($errorMessage != "") { ?>
        <div class="alert alert-danger" role="alert"><?= $errorMessage ?></div>
        <?php } else { ?>
        <div class="alert alert-success" role="alert"><?= $success?></div>
        <?php } ?>
    </div>
</body>
</html>