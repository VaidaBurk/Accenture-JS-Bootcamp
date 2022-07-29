<?php
include("dbConnection.php");

if ($errorMessage === "") :
    $query = "SELECT * FROM customers";
    $result = $connection->query($query);
endif;
?>

<html>
    <head>
        <?php
        include("header.php")
        ?>
    </head>
    <body>
        <?php include("navbar.php"); ?>

        <div class="container mt-5 p-5 justify-content-center rounded-2 bg-dark shadow text-bg-dark">
            <div class="row mb-3">
                <div class="col-2">ID</div>
                <div class="col-3">First Name</div>
                <div class="col-3">Last Name</div>
                <div class="col-4">E-mail</div>

            </div>
            <?php
            while ($entry = $result->fetch_assoc()) :
                echo "<div class='row'>";
                    echo "<div class='col-2 py-1'>";
                    echo($entry["id"]);
                    echo "</div>";

                    echo "<div class='col-3'>";
                    echo($entry["firstname"]);
                    echo "</div>";

                    echo "<div class='col-3'>";
                    echo($entry["lastname"]);
                    echo "</div>";

                    echo "<div class='col-4'>";
                    echo($entry["email"]);
                    echo "</div>";
                echo "</div>";
            endwhile;
            ?>
        </div>
    </body>
</html>