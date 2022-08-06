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

    $scvContentLineArr = fgetcsv($file, filesize($fileName), ";"); // we need this not to save header of file ro DB
    while ($csvContentLineArr = fgetcsv($file, filesize($fileName), ";")){
        $title = $csvContentLineArr[0];
        $leadArtist = $csvContentLineArr[1];
        $genres = $csvContentLineArr[2];
        $yearFoundation = $csvContentLineArr[3];
        $origin = $csvContentLineArr[4];
        $website = $csvContentLineArr[5];

        saveToDB($connection, $title, $leadArtist, $genres, $yearFoundation, $origin, $website);
    }
} 

function saveToDB($connection, $title, $leadArtist, $genres, $yearFoundation, $origin, $website) {
    $prepStatement = $connection->prepare(
        "INSERT INTO bands (Title, Lead_artist, Genres, Year_of_foundation, Origin, Website)
        VALUES (?,?,?,?,?,?)");
    $prepStatement->bind_param("ssssss", $title, $leadArtist, $genres, $yearFoundation, $origin, $website);
    $prepStatement->execute();

} ?>
