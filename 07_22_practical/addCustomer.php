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
    <head></head>
    <body>
        <?php if ($errorMessage != "") { ?>
            <h1 style="color:red"><?= $errorMessage ?></h1>
        <?php } else { ?>
            <h1 style="color:green"><?= $success?></h1> 
        <?php } ?>
    </body>
</html>