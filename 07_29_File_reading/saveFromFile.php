<?php
include("dbConnection.php");

$fileName = $_POST["fileSave"];
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    if ($ext == "csv") {
        saveFromCsvFile($fileName);
    }
    if ($ext == "json") {
        saveFromJson($fileName);
    }

function saveFromCsvFile(string $fileName) {
    $file = fopen($fileName, "r");
    if ($file == false) {
        exit();
    }

    $connection = connectToDB();

    $scvContentLineArr = fgetcsv($file, filesize($fileName), ","); // we need this not to save header of file ro DB
    while ($csvContentLineArr = fgetcsv($file, filesize($fileName), ",")){
        $firstName = $csvContentLineArr[0];
        $lastName = $csvContentLineArr[1];
        $email = $csvContentLineArr[2];
        $phoneNumber = $csvContentLineArr[3];

        saveToDB($connection, $firstName, $lastName, $email, $phoneNumber);
    }
} 

function saveFromJson($fileName){
    $file = fopen($fileName, "r");
    if (!$file) {
        echo ("<h2>File can't be opened.</h2>");
        exit();
    }

    $connection = connectToDB();
    $filecontent = file_get_contents($fileName);
    $customersArr = json_decode($filecontent);

    foreach ($customersArr as $customer) {
        $firstName = $customer->firstName;
        $lastName = $customer->lastName;
        $email = $customer->email;
        $phoneNumber = $customer->phoneNumber;
        saveToDB($connection, $firstName, $lastName, $email, $phoneNumber);
    }
} 

function saveToDB($connection, $firstName, $lastName, $email, $phoneNumber) {
    $prepStatement = $connection->prepare(
        "INSERT INTO customers (firstname, lastname, email, phone)
        VALUES (?,?,?,?)");
    $prepStatement->bind_param("ssss", $firstName, $lastName, $email, $phoneNumber);
    $prepStatement->execute(); ?>

<html>
    <?php include('header.php') ?>
    <body>
        <?php include('navbar.php') ?>
        <div class="alert alert-success m-5 p-5" role="alert">Data added to DB.</div>
    </body>
</html> <?php
} ?>
