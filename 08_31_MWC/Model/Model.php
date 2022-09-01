<?php

namespace App\Model;

use mysqli;

class Model
{
    public static function connectToDB(){
        
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $databasename = "music_bands";
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
}