<?php

include "Band.php";

$bandsToUpdate = json_decode(file_get_contents('php://input'));
$connection = connectToDB();
foreach($bandsToUpdate as $band){
    $bandToUpdate = Band::getInstanceForUpdate($band);
    var_dump($bandToUpdate);
    Band::updateBand($bandToUpdate, $connection);
}
echo json_encode("Bands successfully updated!");