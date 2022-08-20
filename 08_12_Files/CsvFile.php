<?php

class CsvFile extends AnyFile
{
    private string $fileName;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    public function readDataFromFile()
    {
        $bandsArr = [];
        $file = fopen($this->fileName, "r");
        $fileLineArr = fgetcsv($file, filesize($this->fileName), ';');
        if (!$fileLineArr) {
            echo ("<h2>File can't be opened.</h2>");
            exit();
        }

        while ($fileLineArr = fgetcsv($file, filesize($this->fileName), ';')) {
            $band = new Band (
                $title = $fileLineArr[0],
                $leadArtist = $fileLineArr[1],
                $genres = $fileLineArr[2],
                $yearFoundation = $fileLineArr[3],
                $origin = $fileLineArr[4],
                $website = $fileLineArr[5],
            );
            array_push($bandsArr, $band);
        }
        
        fclose($file);
        echo Band::displayAllBandsHtml($bandsArr);
    }

    public function saveDataToFile(string $fileName, array $data)
    {
    }
}
?>