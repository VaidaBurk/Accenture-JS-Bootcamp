<?php

include("dbConnection.php");
getUserRoles();

function getUserRoles()
{
    $connection = connectToDB();
    $prepStatement = $connection->prepare("SELECT * FROM usergroups");
    $prepStatement->execute();
    $result = $prepStatement->get_result();
    $userRoles = [];
    while($entry = $result->fetch_assoc())
    {
        $userGroupEntry = (object) array (
            "id" => $entry["id"],
            "text" => $entry["name"]
        );
        array_push($userRoles, $userGroupEntry);
    }

    echo json_encode($userRoles);
}