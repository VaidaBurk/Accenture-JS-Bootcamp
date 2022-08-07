<?php

use musicBands\Band;

include("Band.php");

$bands = Band::fetchBandsFromDB();

if (isset($_POST["csvFileName"])) {
    Band::saveCSV($_POST["csvFileName"], $bands);
}

if (isset($_POST["jsonFileName"])) {
    Band::saveJSON($_POST["jsonFileName"], $bands);
}
?>

<html>

<head>
    <?php
    include("header.php")
    ?>
</head>

<body>
    <?php include("navbar.php");
    echo Band::displayAllBandsHtml($bands);
    ?>
    <!-- save to file buttons -->
    <div class='pb-3 px-5 m-5'>
        <form class="row g-3 mt-5" method="POST">
            <div class="col-auto">
                <input type="text" readonly class="form-control-plaintext" value="Enter CSV file name">
            </div>
            <div class="col-auto">
            <div class="input-group">
                    <input type="text" class="form-control" placeholder="File name" name="csvFileName">
                    <span class="input-group-text" id="basic-addon2">.csv</span>
                </div>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-secondary mb-3">Save to CSV</button>
            </div>
        </form>
        <form class="row g-3" method="POST">
            <div class="col-auto">
                <input type="text" readonly class="form-control-plaintext" value="Enter JSON file name">
            </div>
            <div class="col-auto">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="File name" name="jsonFileName">
                    <span class="input-group-text" id="basic-addon2">.json</span>
                </div>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-secondary mb-3">Save to JSON</button>
            </div>
        </form>
    </div>
</body>

</html>