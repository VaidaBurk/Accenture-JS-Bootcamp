<?php
if ($_POST["FirstName"] === "" || $_POST["LastName"] === "" || $_POST["Email"] === "") {
    $errorMessage = "First name, Last name and email are mandatory.";
} else {
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $databasename = "js_bootcamp";
    
    $connection = new mysqli($hostname, $username, $password, $databasename);
    
    $errorMessage = "";
    
    if ($connection->connect_error) {
    $errorMessage = $connection->connect_error;
    }
    else {
        $querry = "INSERT INTO customers (firstname, lastname, email, phone)
        VALUES ('" . $_POST["FirstName"] . "','" . $_POST["LastName"] . "', '" . $_POST["Email"] . "','" . $_POST["Phone"] . "')";
        if ($connection->query($querry)) {
            $success = "Customer succesfully added."; 
        } else {
            $errorMessage = $connection->error;
        }
    }
}
?>


<html>
<head>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>    
    </head>
    <body>
        <div class="container p-3">
            <?php if ($errorMessage != "") { ?>
                <div class="alert alert-danger" role="alert"><?= $errorMessage ?></div>
            <?php } else { ?>
                <div class="alert alert-success" role="alert"><?= $success?></div> 
            <?php } ?>
        </div>
    </body>
</html>