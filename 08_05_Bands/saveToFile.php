<?php

function saveCSV(string $fileName, mysqli_result $bands) {
    $fileContent = "";
    $headerline = "Title,LeadArtist,Genres,YearOfFoundation,Origin,Website";
    $fileContent = $headerline;

    while ($entry = $bands->fetch_assoc()){
        $fileContent .= '\n'; //line break

        $title = $entry["Title"];
        $leadArtist = $entry["Lead_artist"];
        $genres = $entry["Genres"];
        $yearFoundation = $entry["Year_of_foundation"];
        $origin = $entry["Origin"];
        $website = $entry["Website"];

        $line = $title . "," . $leadArtist . "," . $genres . "," . $yearFoundation . "," . $origin . "," . $website;
        $fileContent .= $line;
    }

    $file = fopen($fileName, "w");
    fwrite($file, $fileContent);
    fclose($file);
}

function saveJSON(string $fileName, mysqli_result $bands){
    $bandsArr = Array();

    while ($entry = $bands->fetch_assoc()) {
        $band = array(
            "title" => $entry["Title"],
            "leadArtist" => $entry["Lead_artist"],
            "genres" => $entry["Genres"],
            "yearFoundation" => $entry["Year_of_foundation"],
            "origin" => $entry["Origin"],
            "website" => $entry["Website"]
        );
        array_push($bandsArr, $band);
    }

    $json = json_encode(array("band" => $bandsArr), JSON_PRETTY_PRINT);
    file_put_contents($fileName, $json);
}
?>