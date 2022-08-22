<?php
include "dbConnection.php";

class Band
{
    private string $title;
    private string $leadArtist;
    private string $genres;
    private string $yearFoundation;
    private string $origin;
    private string $website;
    protected int $id;

    public function __construct(string $title, string $leadArtist, string $genres, string $yearFoundation, string $origin, string $website, int $id = 0)
    {
        $this->title = $title;
        $this->leadArtist = $leadArtist;
        $this->genres = $genres;
        $this->yearFoundation = $yearFoundation;
        $this->origin = $origin;
        $this->website = $website;
        $this->id = $id;
    }

    public function getBand(): array
    {
        return [
            "title" => $this->title,
            "leadArtist" => $this->leadArtist,
            "genres" => $this->genres,
            "yearFoundation" => $this->yearFoundation,
            "origin" => $this->origin,
            "website" => $this->website,
            "id" => $this->id,
        ];
    }

    public function convertToJson()
    {
        $band = new stdClass();
        $band->title = $this->title;
        $band->leadArtist = $this->leadArtist;
        $band->genres = $this->genres;
        $band->yearFoundation = $this->yearFoundation;
        $band->origin = $this->origin;
        $band->website = $this->website;
        $band->id = $this->id;
        return $band;
    }

    public static function saveBandsToTextArray(array $bands)
    {
        $bandsArr = [];
        foreach ($bands as $bandObj) {
            array_push($bandsArr, $bandObj->getBand());
        }
        return $bandsArr;
    }

    public static function convertBandArrToJSON(array $bands): array
    {
        $bandsJSON = [];
        foreach ($bands as $band)
            array_push($bandsJSON, $band->convertToJson());

        return $bandsJSON;
    }

    public function displayOneRowHtml(): string
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

    public static function displayTableHeaderHtml(): string
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

    public static function displayAllBandsHtml($bands): string
    {
        $htmlContent = "<div class='shadow pt-5 pb-3 px-5 m-5'>
                        <table class='table table-hover table-striped table-borderless'>";
        $htmlContent .= Band::displayTableHeaderHtml();
        $htmlContent .= "<tbody>";
        foreach ($bands as $band) {
            $htmlContent .= $band->displayOneRowHtml();
        }
        $htmlContent .= "</tbody></table></div>";
        return $htmlContent;
    }

    public static function getInstance($band): Band
    {
        return new Band($band->title, $band->leadArtist, $band->genres, $band->yearFoundation, $band->origin, $band->website);
    }

    public static function getInstanceForUpdate($band): Band
    {
        return new Band($band->title, $band->leadArtist, $band->genres, $band->yearFoundation, $band->origin, $band->website, $band->id);
    }

    public static function createBand(Band $band)
    {
        $connection = connectToDB();
        $prepStatement = $connection->prepare("INSERT INTO bands (Title, Lead_artist, Genres, Year_of_foundation, Origin, Website) VALUES (?,?,?,?,?,?)");
        $prepStatement->bind_param("ssssss", $band->title, $band->leadArtist, $band->genres, $band->yearFoundation, $band->origin, $band->website);
        $prepStatement->execute();
    }

    public static function updateBand($band, $con)
    {
        $connection = $con;
        $prepStatement = $connection->prepare("UPDATE bands SET Title = ?, Lead_artist = ?, Genres = ?, Year_of_foundation = ?, Origin = ?, Website = ? WHERE Id = ?");
        $prepStatement->bind_param("ssssssi", $band->title, $band->leadArtist, $band->genres, $band->yearFoundation, $band->origin, $band->website, $band->id);
        $prepStatement->execute();
    }
}
