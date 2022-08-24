<?php

include("AnyFile.php");

$fileName = json_decode(file_get_contents('php://input'));
$fileNameWithPath = "files/" . $fileName;
$file = AnyFile::openFile($fileNameWithPath);
$bands = Band::saveBandsToTextArray($file->readDataFromFile());
echo json_encode($bands);