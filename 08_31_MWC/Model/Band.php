<?php
namespace App\Model;
require __DIR__ . "\Model.php";

use App\Model\Model;
use mysqli;

class Band extends Model
{
    protected string $title;
    protected string $leadArtist;
    protected string $genres;
    protected string $yearFoundation;
    protected string $origin;
    protected string $website;
    protected int $id;

    public function __construct(string $title, string $leadArtist, string $genres, string $yearFoundation, string $origin, string $website, int $id)
    {
        $this->title = $title;
        $this->leadArtist = $leadArtist;
        $this->genres = $genres;
        $this->yearFoundation = $yearFoundation;
        $this->origin = $origin;
        $this->website = $website;
        $this->id = $id;
    }

    public function getTitle() : string {
        return $this->title;
    }

    public function getLeadArtist() : string {
        return $this->leadArtist;
    }

    public function getGenres() : string {
        return $this->genres;
    }

    public function getYearFoundation() : string {
        return $this->yearFoundation;
    }

    public function getOrigin() : string {
        return $this->origin;
    }

    public function getWebsite() : string {
        return $this->website;
    }

    public function getId() : string {
        return $this->id;
    }

    public static function fetchBandsFromDB() : array
    {
        $bands = [];
        $connection = Model::connectToDB();
        $query = "SELECT * FROM bands";
        $result = $connection->query($query);
        while ($resultRow = $result->fetch_assoc())
        {
            $band = new Band (
                $title = $resultRow["Title"],
                $leadArtist = $resultRow["Lead_artist"],
                $genres = $resultRow["Genres"],
                $yearFoundation = $resultRow["Year_of_foundation"],
                $origin = $resultRow["Origin"],
                $website = $resultRow["Website"],
                $id = $resultRow["Id"]
            );
            array_push($bands, $band);
        }
        return $bands;
    }

    public static function selectBandById($id) {
        $connection = Model::connectToDB();
        $id = mysqli_real_escape_string($connection, $id);
        $query = "SELECT * FROM bands WHERE Id = $id";
        $query_run = mysqli_query($connection, $query);
        if(mysqli_num_rows($query_run) > 0)
        {
            $result = mysqli_fetch_assoc($query_run);
            $band = new Band (
                $title = $result["Title"],
                $leadArtist = $result["Lead_artist"],
                $genres = $result["Genres"],
                $yearFoundation = $result["Year_of_foundation"],
                $origin = $result["Origin"],
                $website = $result["Website"],
                $id = $result["Id"]);
        }
        else
        {
            echo "<h4>No such ID found</h4>";
        }
        return $band;
    }

    public static function saveBandToDB(Band $band)
    {
        $count = 0;
        $connection = connectToDB();
        $prepStatement = $connection->prepare("INSERT INTO bands (Title, Lead_artist, Genres, Year_of_foundation, Origin, Website) VALUES (?,?,?,?,?,?)");
        $prepStatement->bind_param("ssssss", $band->title, $band->leadArtist, $band->genres, $band->yearFoundation, $band->origin, $band->website);
        if ($prepStatement->execute())
        $count = $prepStatement->num_rows();
        
        return $count;
    }

    public static function editBand($id)
    {
        $band = Band::selectBandById($id);
    }

    public static function saveEdited($id, $title, $leadArtist, $genres, $origin, $yearFoundation, $website)
    {
        $connection = Model::connectToDB();
        $prepStatement = $connection->prepare("UPDATE bands SET Title = ?, Lead_artist = ?, Genres = ?, Year_of_foundation = ?, Origin = ?, Website = ? WHERE Id = ?");
        $prepStatement->bind_param("ssssssi", $title, $leadArtist, $genres, $yearFoundation, $origin, $website, $id);
        $prepStatement->execute();
        
    }
}

?>