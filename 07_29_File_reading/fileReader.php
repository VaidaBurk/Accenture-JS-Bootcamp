<?php

function openFile(string $fileName){
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $fileContent = "";
    if ($ext == "txt") {
        $fileContent = readTxtFile($fileName);
    }
    if ($ext == "csv") {
        readCsvFile($fileName);
    }
    if ($ext == "xml") {
        readXmlFile($fileName);
    }
    if ($ext == "json") {
        readJson($fileName);
    }
    // else {
    //     echo "<h2>File format is not recognized.</h2>";
    // }
    echo $fileContent;
}

function readTxtFile(string $fileName){
    $file = fopen($fileName, "r");
    if (!$file) {
        $fileContent = "<h2>File can't be opened.</h2>";
        exit();
        return $fileContent;
    }

    $fileContent = fread($file, filesize($fileName));
    fclose($file);
    return "<pre class='mx-5 my-3 p-5 border shadow'>$fileContent</pre>";
}

function readCsvFile(string $fileName){
    $file = fopen($fileName, "r");
    if ($file == false) {
        echo ("<h2>File can't be opened.</h2>");
        exit();
    }

    $fileLineArr = fgetcsv($file, filesize($fileName), ",");
    if (!$fileLineArr) {
        echo ("<h2>File can't be opened.</h2>");
        exit();
    }


    echo ('<div class="border shadow pt-5 pb-3 px-5 m-5">');
    echo ('<table class="table">');
    echo ('<thead>');
    echo ('<tr>');

    foreach ($fileLineArr as $fieldName) {
        echo ('<th scope="col">');
        echo $fieldName;
        echo ('</th>');
    }
            
    echo ('</tr>');
    echo ('</thead>');

    while ($fileLineArr = fgetcsv($file, filesize($fileName), ",")) {
        echo ('<tbody>');
        echo ('<tr>');
        foreach ($fileLineArr as $fieldValue) {
            echo ('<td>');
            echo $fieldValue;
            echo ('</td>');
        }

        echo ('</tr>');
        echo ('</tbody>');
    }

    echo ('</table>');
    echo ('</div>');
    fclose($file);
}

function readXmlFile($fileName){
    $file = fopen($fileName, "r");
    if (!$file) {
        echo ("<h2>File can't be opened.</h2>");
        exit();
    }

    $content = '<div class="border shadow pt-5 pb-3 px-5 m-5">
                <table class="table">
                <tbody>';

    $xmlDoc = new DOMDocument();
    $xmlDoc->load($fileName);

    $customers = $xmlDoc->documentElement; //root element
    foreach($customers->childNodes as $customer) {
        $content .= "<tr>";
            foreach($customer->childNodes as $element){
                if ($element->nodeType === XML_TEXT_NODE){
                    continue;
                }
                $content .= "<td>";
                $content .= $element->nodeValue;
                $content .= "</td>";
            }
        $content .= "</tr>";
    }

    echo ($content);
    fclose($file);
}

function readJson ($fileName){
    $file = fopen($fileName, "r");
    if (!$file) {
        echo ("<h2>File can't be opened.</h2>");
        exit();
    }
    $filecontent = file_get_contents($fileName);
    $customersArr = json_decode($filecontent);

    echo ('<div class="border shadow pt-5 pb-3 px-5 m-5">');
    echo ('<table class="table">');

    foreach ($customersArr as $customer) {
        echo ('<tbody>');
        echo ('<tr>');
            echo ('<td>');
            echo $customer->firstName;
            echo ('</td>');
            echo ('<td>');
            echo $customer->lastName;
            echo ('</td>');
            echo ('<td>');
            echo $customer->email;
            echo ('</td>');
            echo ('<td>');
            echo $customer->phoneNumber;
            echo ('</td>');
        echo ('</tr>');
        echo ('</tbody>');
    }

    echo ('</table>');
    echo ('</div>');
    fclose($file);
}
