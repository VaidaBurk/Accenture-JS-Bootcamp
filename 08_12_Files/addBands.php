<?php

include "Band.php";

$bandsToSave = json_decode(file_get_contents('php://input'));
$connection = connectToDB();
foreach($bandsToSave as $band){
    $bandToUpdate = Band::getInstanceForUpdate($band);
    Band::saveBandToDB($bandToUpdate, $connection);
}
echo json_encode("Bands successfully saved in DB!");