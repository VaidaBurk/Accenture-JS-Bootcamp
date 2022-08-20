<?php

include "Band.php";

$bandInput = json_decode(file_get_contents('php://input'));
$bandInput->id = null;
$bandObj = Band::getInstance($bandInput);
Band::createBand($bandObj);
echo json_encode("The customer is created.");