<?php
$hostname = "localhost";
$username = "root";
$password = "";
$databasename = "js_bootcamp";

$connection = new mysqli($hostname, $username, $password, $databasename);

$errorMessage = "";
$entry = [];

if ($connection->connect_error) {
    $errorMessage = $connection->connect_error;
} else {
    $querry = "SELECT * FROM customers WHERE id = " . $_POST["CustomerId"] . " ";
    $result = $connection->query($querry);
    if ($result->num_rows == 0) {
        $errorMessage = "No entries found.";
    } else {
        $entry = $result->fetch_assoc();
    }
}
?>


<html>
<?php
include("header.php");
?>

<body>
    <!-- navbar -->
    <?php include("navbar.php"); ?>
    <div class="container p-3">
        <?php if ($errorMessage != "") { ?>
            <div class="alert alert-danger" role="alert"><?= $errorMessage ?></div>
        <?php } else { ?>
            <div class="container">
                <form action="updateInfoView.php" method="POST">
                    <div class="row d-flex justify-content-center mt-5 rounded-2 bg-dark shadow text-bg-dark">
                        <div class="col-4 p-5">
                            <?php
                            if ($entry["photo"] == null) { ?>
                                <img src="photos/default.jpg" alt="img" class="w-100 rounded"> <?php
                            } else { ?>
                                <img src="photos/<?= $entry["photo"] ?>" alt="img" class="w-100 rounded"> <?php
                            }
                            ?>
                        </div>
                        <div class="col-8 p-5" id="costumerCard">
                            <h3>Customer Info</h3>
                            <div class="row">
                                <label class="col-3" for="customerId">ID</label>
                                <input class="col-4" name="customerId" id="customerId" value=<?= $entry["id"] ?> readonly></input>
                            </div>
                            <div class="row">
                                <label class="col-3" for="firstName">First Name</label>
                                <input class="col-4" name="firstName" id="firstName" value=<?= $entry["firstname"] ?> readonly></input>
                            </div>
                            <div class="row">
                                <label class="col-3" for="lastName">Last Name</label>
                                <input class="col-4" name="lastName" id="lastName" value=<?= $entry["lastname"] ?> readonly></input>
                            </div>
                            <div class="row">
                                <label class="col-3" for="email">Email</label>
                                <input class="col-4" name="email" id="email" value=<?= $entry["email"] ?> readonly></input>
                            </div>
                            <div class="row">
                                <label class="col-3" for="phoneNumber">Phone number</label>
                                <input class="col-4" name="phoneNumber" id="phoneNumber" value=<?= $entry["phone"] ?> readonly></input>
                            </div>
                            <div class="row">
                                <label class="col-3" for="comments">Comments</label>
                                <input class="col-4" name="comments" id="comments" value=<?= $entry["comments"] ?> readonly></input>
                            </div>
                            <button class="btn btn-secondary mt-3" type="submit">Update Info</button>
                        </div>
                    </div>
                </form>
            </div>
        <?php } ?>
    </div>
</body>

</html>