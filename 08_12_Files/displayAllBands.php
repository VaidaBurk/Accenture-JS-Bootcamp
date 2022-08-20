<?php
include "AnyFile.php";

$connection = connectToDB();
if ($connection !== null) {
    $bands = Band::saveBandsToTextArray(AnyFile::fetchDataFromDB());
    echo json_encode($bands);
}

?>