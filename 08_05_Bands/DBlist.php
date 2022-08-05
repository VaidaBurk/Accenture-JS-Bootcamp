<?php
include("dbConnection.php");
include("saveToFile.php");

$connection = connectToDB();
$query = "SELECT * FROM bands";
$result = $connection->query($query);

if (isset($_POST["csvFileName"])) {
    saveCSV($_POST["csvFileName"], $result);
}

if (isset($_POST["jsonFileName"])) {
    saveJSON($_POST["jsonFileName"], $result);
}
?>

<html>

<head>
    <?php
    include("header.php")
    ?>
</head>

<body>
    <?php include("navbar.php") ?>
    <div class="container mt-5 p-5 justify-content-center rounded-2 shadow">
        <div class="row mb-3">
            <div class="col-1">ID</div>
            <div class="col-2">Title</div>
            <div class="col-2">Lead artist</div>
            <div class="col-2">Genres</div>
            <div class="col-1">Year of foundation</div>
            <div class="col-2">Origin</div>
            <div class="col-2">Website</div>
        </div>
        <?php
        while ($entry = $result->fetch_assoc()) :
            echo "<div class='row'>";
            echo "<div class='col-1 py-1'>";
            echo ($entry["Id"]);
            echo "</div>";

            echo "<div class='col-2'>";
            echo ($entry["Title"]);
            echo "</div>";

            echo "<div class='col-2'>";
            echo ($entry["Lead_artist"]);
            echo "</div>";

            echo "<div class='col-2'>";
            echo ($entry["Genres"]);
            echo "</div>";

            echo "<div class='col-1'>";
            echo ($entry["Year_of_foundation"]);
            echo "</div>";

            echo "<div class='col-2'>";
            echo ($entry["Origin"]);
            echo "</div>";

            echo "<div class='col-2'>";
            echo ($entry["Website"]);
            echo "</div>";
            echo "</div>";
        endwhile;
        ?>
        <form class="row g-3 mt-5" method="POST">
            <div class="col-auto">
                <input type="text" readonly class="form-control-plaintext" value="Enter CSV file name">
            </div>
            <div class="col-auto">
                <input type="text" class="form-control" id="csvName" name="csvFileName" placeholder="filename.csv">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-secondary mb-3">Save to file</button>
            </div>
        </form>
        <form class="row g-3" method="POST">
            <div class="col-auto">
                <input type="text" readonly class="form-control-plaintext" value="Enter JSON file name">
            </div>
            <div class="col-auto">
                <input type="text" class="form-control" name="jsonFileName" placeholder="filename.json">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-secondary mb-3">Save to file</button>
            </div>
        </form>
    </div>
</body>

</html>