<?php
include "CsvFile.php";
include "JsonFile.php";
include "Band.php";

abstract class AnyFile
{
    abstract public function readDataFromFile();
    abstract public function saveDataToFile(string $fileName, array $data);

    public static function fetchDataFromDB()
    {
        $bandsArr = [];
        $connection = connectToDB();
        $query = "SELECT * FROM bands";
        $result = $connection->query($query);
        while ($resultRow = $result->fetch_assoc()){
            $band = new Band (
                $title = $resultRow["Title"],
                $leadArtist = $resultRow["Lead_artist"],
                $genres = $resultRow["Genres"],
                $yearFoundation = $resultRow["Year_of_foundation"],
                $origin = $resultRow["Origin"],
                $website = $resultRow["Website"],
                $id = $resultRow["Id"],
            );
            array_push($bandsArr, $band);
        }
        return $bandsArr;
    }

    public static function openFile(string $fileName) : AnyFile
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
