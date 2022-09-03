<?php

include("dbConnection.php");

function checkExists($username, $password, string $roleID) : bool
{
    $connection = connectToDB();
    $prepStatement = $connection->prepare("SELECT `password`, `role_id` FROM users WHERE `username` = ?");
    $prepStatement->bind_param("s", $username);
    $prepStatement->execute();
    $result = $prepStatement->get_result();
    if (mysqli_num_rows($result) == 0){
        return false;
    }
    $resultValues = $result->fetch_assoc();
    $passwordDB = $resultValues["password"];
    if (password_verify($password, $passwordDB)) {
        $roleID = $resultValues["role_id"];
        return true;
    }
    else {
        return false;
    }
}

$newUser = json_decode(file_get_contents('php://input'));
$roleID = "";
$userExists = checkExists($newUser->username, $newUser->password, $roleID);
$response = (object) array("userExists" => $userExists, "roleID"=>$roleID);
echo json_encode($response);

//neveikia, nes roleID nusisiuncia kaip tuscias stringas. reikia pataisyti

?>