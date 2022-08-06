<?php
    function connectToDB(string $DBname){
        
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $databasename = $DBname;
    $errorMessage = "";
    
    $connection = new mysqli($hostname, $username, $password, $databasename);
    
        if ($connection->connect_error) {
            $errorMessage = $connection->connect_error;
            echo ('<div class="alert alert-danger" role="alert">');
            echo ($errorMessage);
            echo ('</div>');
        }

    return $connection;
    }
?>