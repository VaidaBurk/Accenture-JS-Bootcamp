<?php
namespace musicBands;

include("dbConnection.php");

class Band {
    private string $title;
    private string $leadArtist;
    private string $genres;
    private string $yearFoundation;
    private string $origin;
    private string $website;

    public function __construct(string $title, string $leadArtist, string $genres, string $yearFoundation, string $origin, string $website)
    {
        $this->title = $title;
        $this->leadArtist = $leadArtist;
        $this->genres = $genres;
        $this->yearFoundation = $yearFoundation;
        $this->origin = $origin;
        $this->website = $website;
    }

    public static function fetchBandsFromDB() : array
    {
        $bands = [];
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
            );
            array_push($bands, $band);
        }
        return $bands;
    }

    public static function fetchBandsFromJSON(string $fileName) : array
    {
        $bands = [];
        $fileContent = file_get_contents($fileName);
        $jsonContent = json_decode($fileContent);
        foreach ($jsonContent as $resultRow){
            $band = new Band (
                $title = $resultRow->title,
                $leadArtist = $resultRow->leadArtist,
                $genres = $resultRow->genres,
                $yearFoundation = $resultRow->yearFoundation,
                $origin = $resultRow->origin,
                $website = $resultRow->website,
            );
            array_push($bands, $band);
        }
        return $bands;
    }

    public static function fetchBandsFromCSV(string $fileName) : array
    {
        $bands = [];
        $file = fopen($fileName, "r");
        if ($file == false) {
            echo ("<h2>File can't be opened.</h2>");
            exit();
        }
    
        $fileLineArr = fgetcsv($file, filesize($fileName), ';');
        if (!$fileLineArr) {
            echo ("<h2>File can't be opened.</h2>");
            exit();
        }

        while ($fileLineArr = fgetcsv($file, filesize($fileName), ';')) {
            $band = new Band (
                $title = $fileLineArr[0],
                $leadArtist = $fileLineArr[1],
                $genres = $fileLineArr[2],
                $yearFoundation = $fileLineArr[3],
                $origin = $fileLineArr[4],
                $website = $fileLineArr[5],
            );
            array_push($bands, $band);
        }
        
        fclose($file);
        return $bands;
    }

    public function displayOneRowHtml() : string
    {
        $htmlContent = "";
            $htmlContent .= "<tr>
                    <td>" . $this->title . "</td>
                    <td>" . $this->leadArtist . "</td>
                    <td>" . $this->genres . "</td>
                    <td>" . $this->yearFoundation . "</td>
                    <td>" . $this->origin . "</td>
                    <td>" . $this->website . "</td>
                    </tr>";
        return $htmlContent;
    }

    public static function displayTableHeaderHtml() : string
    {
        $htmlContent = "<thead class='table-dark'>";
            $htmlContent .= "<tr>
                    <th>Title</th>
                    <th>Lead artist</th>
                    <th>Genres</th>
                    <th>Year of foundation</th>
                    <th>Origin</th>
                    <th>Website</th>
                    </tr></thead>";
        return $htmlContent;
    }

    public static function displayAllBandsHtml($bands) : string
    {
        $htmlContent = "<div class='shadow pt-5 pb-3 px-5 m-5'>
                        <table class='table table-hover table-striped table-borderless'>";
        $htmlContent .= Band::displayTableHeaderHtml();
        $htmlContent .= "<tbody>";
        foreach ($bands as $band){
            $htmlContent .= $band->displayOneRowHtml();
        }
        $htmlContent .= "</tbody></table></div>";
        return $htmlContent;
    }

    public static function saveCSV(string $fileName, array $bands) {
        $fileContent = "";
        $headerline = "Title;LeadArtist;Genres;YearOfFoundation;Origin;Website";
        $fileContent = $headerline;
    
        foreach($bands as $band){
            $fileContent .= "\n"; //line break
    
            $title = $band->title;
            $leadArtist = $band->leadArtist;
            $genres = $band->genres;
            $yearFoundation = $band->yearFoundation;
            $origin = $band->origin;
            $website = $band->website;
    
            $line = $title . ";" . $leadArtist . ";" . $genres . ";" . $yearFoundation . ";" . $origin . ";" . $website;
            $fileContent .= $line;
        }
    
        $file = fopen($fileName . ".csv", "w");
        fwrite($file, $fileContent);
        fclose($file);
    }

    public static function saveJSON(string $fileName, array $bands){
        $bandsArr = Array();

        foreach($bands as $oneBand){
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
    }

    public static function saveFromFile(string $fileName) {
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        if ($ext == "csv") {
            $bands = Band::fetchBandsFromCSV($fileName);
        }
        if ($ext == "json") {
            $bands = Band::fetchBandsFromJSON($fileName);
        }
    
        foreach($bands as $band){
            $title = $band->title;
            $leadArtist = $band->leadArtist;
            $genres = $band->genres;
            $yearFoundation = $band->yearFoundation;
            $origin = $band->origin;
            $website = $band->website;
    
            Band::saveToDB($title, $leadArtist, $genres, $yearFoundation, $origin, $website);
        }
    } 

    public static function saveToDB($title, $leadArtist, $genres, $yearFoundation, $origin, $website) {
        $connection = connectToDB();
        $prepStatement = $connection->prepare(
            "INSERT INTO bands (Title, Lead_artist, Genres, Year_of_foundation, Origin, Website)
            VALUES (?,?,?,?,?,?)");
        $prepStatement->bind_param("ssssss", $title, $leadArtist, $genres, $yearFoundation, $origin, $website);
        $prepStatement->execute();

        
    }
}