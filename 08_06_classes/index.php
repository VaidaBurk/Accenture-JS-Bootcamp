<?php 
include("../common/header.php");
include("Person.php");

// If we don't have constructor:
// $newPerson = new Person();
// $newPerson->setData("Harry", "Potter");
// echo "<div>" . $newPerson->getFullName() . "</div>";

use Demo\Person;

echo "<div>Total population of the world: " . Person::getWorldPersonCount() . "</div>";

// If we have constructor:
$myPerson = new Person("Vaida", "Burkauskaite");

// If constructor is private:
$nextPerson = Person::getInstance("Vaida", "Burk");
echo "<div>" . $myPerson->getFullName() . "</div>";
?>