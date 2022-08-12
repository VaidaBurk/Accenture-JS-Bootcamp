<?php
include("MyParentClass.php");
include("abstraction.php");
include("defineInterface.php");

$ovrObject = new MySubClass("string1", "string2", "string3");
$ovrObject->showProperties();

$ovrObject = new MyParentClass("string1", "string2");
$ovrObject->showProperties();

$shape = Shape::getInstance(10, 13, 4);
echo $shape->surface();

$shape1 = Shape::getInstance(4, 23);
echo $shape1->surface();

?>