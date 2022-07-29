<?php
$id = $_POST["customerId"];
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$email = $_POST["email"];
$phoneNumber = $_POST["phoneNumber"];
$comments = $_POST["comments"];
?>


<html>
<?php
include("header.php");
?>

<body>
    <!-- navbar -->
    <?php include("navbar.php"); ?>
        <div class="container py-3 px-4">
            <form action="updateInfo.php" method="POST">
            <div class="row d-flex justify-content-center mt-5">
                <div class="col-12 rounded-2 bg-dark shadow text-bg-dark p-5">
                    <h3 class="mb-5">Customer Info</h3>
                    <div class="row" hidden>
                        <label class="col-3" for="customerId">ID</label>
                        <input class="col-5" name="customerId" id="customerId" value=<?= $id ?>></input>
                    </div>
                    <div class="row">
                        <label class="col-3" for="firstName">First Name</label>
                        <input class="col-5" name="firstName" id="firstName" value=<?= $firstName ?>></input>
                    </div>
                    <div class="row">
                        <label class="col-3" for="lastName">Last Name</label>
                        <input class="col-5" name="lastName" id="lastName" value=<?= $lastName ?>></input>
                    </div>
                    <div class="row">
                        <label class="col-3" for="email">Email</label>
                        <input class="col-5" name="email" id="email" value=<?= $email ?>></input>
                    </div>
                    <div class="row">
                        <label class="col-3" for="phoneNumber">Phone number</label>
                        <input class="col-5" name="phoneNumber" id="phoneNumber" value=<?= $phoneNumber ?>></input>
                    </div>
                    <div class="row">
                        <label class="col-3" for="comments">Comments</label>
                        <input class="col-5" name="comments" id="comments" value=<?= $comments ?>></input>
                    </div>
                    <button class="btn btn-secondary mt-3" type="submit">Update Info</button>
                    <a class="btn btn-secondary mt-3" type="submit" href="http://localhost/07_22_Gotham_night_club/selectCustomer.php?CustomerId=<?=$id?>">Cancel</a>
                </div>
                </div>

        </div>
        </form>
    </div>
</body>

</html>