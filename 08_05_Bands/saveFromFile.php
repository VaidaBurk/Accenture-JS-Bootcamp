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
        $title = $csvContentLineArr[0];
        $leadArtist = $csvContentLineArr[1];
        $genres = $csvContentLineArr[2];
        $yearFoundation = $csvContentLineArr[3];
        $origin = $csvContentLineArr[4];
        $website = $csvContentLineArr[5];

        saveToDB($connection, $title, $leadArtist, $genres, $yearFoundation, $origin, $website);
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
    $bands = json_decode($filecontent);

    foreach ($bands as $band) {
        $title = $band->title;
        $leadArtist = $band->leadArtist;
        $genres = $band->genres;
        $yearFoundation = $band->yearFoundation;
        $origin = $band->origin;
        $website = $band->website;

        saveToDB($connection, $title, $leadArtist, $genres, $yearFoundation, $origin, $website);
    } ?>

    <html>
    <?php include('header.php') ?>
    <body>
        <?php include('navbar.php') ?>
        <div class="alert alert-success m-5 p-5" role="alert">Data added to DB.</div>
    </body>
</html> <?php
}

function saveToDB($connection, $title, $leadArtist, $genres, $yearFoundation, $origin, $website) {
    $prepStatement = $connection->prepare(
        "INSERT INTO bands (Title, Lead_artist, Genres, Year_of_foundation, Origin, Website)
        VALUES (?,?,?,?,?,?)");
    $prepStatement->bind_param("ssssss", $title, $leadArtist, $genres, $yearFoundation, $origin, $website);
    $prepStatement->execute();

} ?>
