<?php

function saveCustomersToCsv(string $fileName, mysqli_result $customers) {
    $fileContent = "";
    $headerline = "FistName,LastName,Email,PhoneNumber";
    $fileContent = $headerline;

    while ($entry = $customers->fetch_assoc()){
        $fileContent .= '\n'; //line break
        $firstName = $entry["firstname"];
        $lastName = $entry["lastname"];
        $email = $entry["email"];
        $phoneNumber = $entry["phone"];
        $line = $firstName . "," . $lastName . "," . $email . "," . $phoneNumber;
        $fileContent .= $line;
    }

    $file = fopen($fileName, "w");
    fwrite($file, $fileContent);
    fclose($file);
}

function saveJSON(string $filename, mysqli_result $customers){
    $customersArr = Array();

    while ($entry = $customers->fetch_assoc()) {
        $customer = array(
            "firstname" => $entry["firstname"],
            "lastname" => $entry["lastname"],
            "email" => $entry["email"],
            "phonenumber" => $entry["phone"]
        );
        array_push($customersArr, $customer);
    }

    $json = json_encode(array("customer" => $customersArr), JSON_PRETTY_PRINT);
    file_put_contents($filename, $json);
}



?>