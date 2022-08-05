<?php
include("dbConnection.php");
include("saveToFile.php");

$connection = connectToDB();
$query = "SELECT * FROM customers";
$result = $connection->query($query);

if (isset($_POST["fileName"])) {
    saveCustomersToCsv($_POST["fileName"], $result);
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
            <div class="col-2">First Name</div>
            <div class="col-3">Last Name</div>
            <div class="col-3">E-mail</div>
            <div class="col-3">Phone</div>
        </div>
        <?php
        while ($entry = $result->fetch_assoc()) :
            echo "<div class='row'>";
            echo "<div class='col-1 py-1'>";
            echo ($entry["id"]);
            echo "</div>";

            echo "<div class='col-2'>";
            echo ($entry["firstname"]);
            echo "</div>";

            echo "<div class='col-3'>";
            echo ($entry["lastname"]);
            echo "</div>";

            echo "<div class='col-3'>";
            echo ($entry["email"]);
            echo "</div>";

            echo "<div class='col-3'>";
            echo ($entry["phone"]);
            echo "</div>";
            echo "</div>";
        endwhile;
        ?>
        <form class="row g-3 mt-5" method="POST">
            <div class="col-auto">
                <label for="staticEmail2" class="visually-hidden">Save to csv file</label>
                <input type="text" readonly class="form-control-plaintext" value="Enter SCV file name">
            </div>
            <div class="col-auto">
                <label for="inputFileName" class="visually-hidden">Password</label>
                <input type="text" class="form-control" id="inputFileName" name="fileName" placeholder="filename.csv">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-secondary mb-3">Save to file</button>
            </div>
        </form>
        <form class="row g-3" method="POST">
            <div class="col-auto">
                <label for="staticEmail2" class="visually-hidden">Save to json file</label>
                <input type="text" readonly class="form-control-plaintext" value="Enter JSON file name">
            </div>
            <div class="col-auto">
                <label for="inputFileName" class="visually-hidden">Password</label>
                <input type="text" class="form-control" name="jsonFileName" placeholder="filename.json">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-secondary mb-3">Save to file</button>
            </div>
        </form>
    </div>
</body>

</html>