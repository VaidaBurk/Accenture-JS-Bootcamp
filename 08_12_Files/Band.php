<?php

class Band
{
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
}
?>