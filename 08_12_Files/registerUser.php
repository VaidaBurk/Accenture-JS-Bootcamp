<?php

include("dbConnection.php");

function createUser(string $username, string $password, int $role_id)
{
    $connection = connectToDB();
    $prepStatement = $connection->prepare("INSERT INTO users (`username`, `password`, `role_id`) VALUES (?,?,?)");
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $prepStatement->bind_param("ssi", $username, $passwordHash, $role_id);
    $prepStatement->execute();
}

function userExists(string $username) : bool
{
    $connection = connectToDB();
    $prepStatement = $connection->prepare("SELECT COUNT(1) as `count` FROM users WHERE `Username` = ?");
    $prepStatement->bind_param("s", $username);
    $prepStatement->execute();
    $result = $prepStatement->get_result();
    $count =intval($result->fetch_assoc()["count"]); 
    if ($count == 1) {
        return true;
    }
    else {
        return false;
    }
}

$newUser = json_decode(file_get_contents('php://input'));
if (userExists($newUser->username)){
    $response = (object) array("userCreated"=>false, "username"=>$newUser->username, "error"=>"User already exists.");
}
else {
    createUser($newUser->username, $newUser->password, $newUser->userRole);
    $response = (object) array("userCreated"=>true, "username"=>$newUser->username, "error"=>"");
    echo json_encode($response);
}
