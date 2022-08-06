<?php 
include("../common/header.php");
include("Band.php");

use musicBands\Band;

echo Band::displayAllBandsHtml(Band::fetchBandsFromDB());