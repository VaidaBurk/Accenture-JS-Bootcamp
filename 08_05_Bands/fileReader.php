<?php
use musicBands\Band;
    include("Band.php");

function openFile(string $fileName){
    $file = fopen($fileName, "r");
    if (!$file || $fileName == "") {
        echo ("<h2>File can't be opened.</h2>");
        exit();
    }

    $ext = pathinfo($fileName, PATHINFO_EXTENSION);

    if ($ext == "csv") {
        $bands = Band::fetchBandsFromCSV($fileName);
    }
    if ($ext == "xml") {
        readXmlFile($fileName);
    }
    if ($ext == "json") {
        $bands = Band::fetchBandsFromJSON($fileName);
    }
    echo Band::displayAllBandsHtml($bands);
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
