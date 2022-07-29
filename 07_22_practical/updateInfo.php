<?php

$id = $_POST["customerId"];
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$email = $_POST["email"];
$phoneNumber = $_POST["phoneNumber"];
$comments = $_POST["comments"];

if ($_POST["firstName"] === "" || $_POST["lastName"] === "" || $_POST["email"] === "") {
    $errorMessage = "First name, Last name and email are mandatory.";
} else {
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $databasename = "js_bootcamp";
    
    $connection = new mysqli($hostname, $username, $password, $databasename);
    
    $errorMessage = "";
    
    if ($connection->connect_error) {
    $errorMessage = $connection->connect_error;
    }
    else {
        $querry = "UPDATE `customers` SET 
        `firstname`='$firstName',`lastname`='$lastName',`email`='$email',`phone`='$phoneNumber',`comments`='$comments' WHERE id=$id";
        
        if ($connection->query($querry)) {
            $success = "Customer succesfully updated."; 
        } else {
            $errorMessage = $connection->error;
        }
    }
}
?>

<html>

<?php
    include("header.php");
?>

<body>
    <?php include("navbar.php"); ?>
    <div class="container p-3">
        <?php if ($errorMessage != "") { ?>
        <div class="alert alert-danger" role="alert"><?= $errorMessage ?></div>
        <?php } else { ?>
        <div class="alert alert-success" role="alert"><?= $success?></div>
        <?php } ?>
    </div>
</body>

</html>