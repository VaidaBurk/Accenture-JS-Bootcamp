<?php
use musicBands\Band;

include "Band.php";

$connection = connectToDB();
if ($connection !== null)
{
    $bandsResult = Band::fetchBandsFromDB();
    echo Band::getJSON($bandsResult);
}
