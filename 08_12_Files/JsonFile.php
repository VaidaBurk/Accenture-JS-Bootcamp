<?php

class JsonFile extends AllFiles
{
    private string $fileName;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    public function readDataFromFile()
    {
        $bandsArr = [];
        $fileContent = file_get_contents($this->fileName);
        $bandsJson = json_decode($fileContent);
        foreach ($bandsJson->band as $resultRow){
            $band = new Band (
                $title = $resultRow->title,
                $leadArtist = $resultRow->leadArtist,
                $genres = $resultRow->genres,
                $yearFoundation = $resultRow->yearFoundation,
                $origin = $resultRow->origin,
                $website = $resultRow->website,
            );
            array_push($bandsArr, $band);
        }
        echo Band::displayAllBandsHtml($bandsArr);
    }

    public function saveDataToFile(string $fileName, array $data)
    {
        $bandsArr = Array();

        foreach($data as $oneBand){
            $band = array (
                "title" => $oneBand->title,
                "leadArtist" => $oneBand->leadArtist,
                "genres" => $oneBand->genres,
                "yearFoundation" => $oneBand->yearFoundation,
                "origin" => $oneBand->origin,
                "website" => $oneBand->website
            );
            array_push($bandsArr, $band);
        }
    
        $json = json_encode(array("band" => $bandsArr), JSON_PRETTY_PRINT);
        file_put_contents($fileName . ".json", $json);

        return "<div class='alert alert-success m-5 p-3' role='alert'>File saved.</div>";
    }
}
?>