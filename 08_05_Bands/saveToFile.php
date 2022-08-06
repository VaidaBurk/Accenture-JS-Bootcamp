<?php

function saveJSON(string $fileName, array $bands){
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