<?php
include "CsvFile.php";
include "JsonFile.php";
include "Band.php";

abstract class AllFiles
{
    abstract public function readDataFromFile();
    abstract public function saveDataToFile(string $fileName, array $data);

    public function fetchDataFromDB()
    {

    }

    public function saveDataToDB()
    {

    }

    public static function openFile(string $fileName) : AllFiles
    {
        $file = fopen($fileName, "r");
        if (!$file || $fileName == "") {
            echo ("<h2>File can't be opened.</h2>");
            exit();
        }
    
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    
        if ($ext == "json") {
            $jsonFile = new JsonFile($fileName);
            return $jsonFile;
        }
        if ($ext == "csv") {
            $csvFile = new CsvFile($fileName);
            return $csvFile;
        }
    }
}
?>