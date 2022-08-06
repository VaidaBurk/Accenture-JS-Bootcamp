<?php

// Encapsulation
// Access modifiers - public, private, static, protected
// Private can be accessesd only from this class
// Static functions can access only static attributes
namespace Demo;

class Person {
    // atributes (values):
    private string $name = "";
    private string $lastName = "";
    private static int $totalPopulation = 7999999999;

    //constructor (can be only one in class)
    public function __construct(string $name, string $lastName)
    {
        $this->name = $name;
        $this->lastName = $lastName;
    }

    // if constructor is private (used with some inheritance things)
    public static function getInstance(string $name, string $lastName) : Person
    {
        return new Person($name, $lastName);
    }

    // the way to implement multiple constructors
    public static function getInstanceWithLastName(string $lastName) : Person
    {
        return new Person("", $lastName);
    }

    // functions (behaviour):
    public function setData(string $name, string $lastName)
    {
        $this->name = $name;
        $this->lastName = $lastName;
    }

    public function getFullName() : string
    {
        return $this->name . " " . $this->lastName;
    }

    public static function getWorldPersonCount() : int
    {
        return Person::$totalPopulation; // Person:: - returns static attributes
    }

    public static function increasePopulation() : int
    {
        return Person::$totalPopulation++;
    }

    public function __toString() // presents the object as a string
    {
        return $this->getFullName();
    }
}

?>