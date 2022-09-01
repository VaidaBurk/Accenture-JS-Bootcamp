<?php
namespace App\Controller;
require_once "../08_31_MWC/Model/Band.php";

use App\Model\Band;

class BandController
{
    public function display()
    {
        $bands = Band::fetchBandsFromDB();
        require_once __DIR__ . '/../Views/allBandsView.php';
    }

    public function edit()
    {
        if(isset($_GET['id'])){
            $bandId = $_GET['id'];
            $band = Band::selectBandById($bandId);
        }
        require_once __DIR__ . '/../Views/editBandView.php';
    }

    public function saveEdited()
    {
        if(isset($_POST['saveEdited']))
        {
            $id = $_POST["id"];
            $title = $_POST["title"];
            $leadArtist = $_POST["lead-artist"];
            $genres = $_POST["genres"];
            $yearFoundation = $_POST["year-foundation"];
            $origin = $_POST["origin"];
            $website = $_POST["website"];
            Band::saveEdited($id, $title, $leadArtist, $genres, $yearFoundation, $origin, $website);
        }
    }
}