<?php

include("Person.php");

class Customer extends Person
{
    private string $phone, $email;

    public function getCustomer() : array
    {
        return [
            "firstname" => $this->firstname,
            "lastname" => $this->lstname,
            "phone" => $this->phone,
            "email" => $this->email
        ];
    }

    public function getFirstname() : string
    {
        return $this->firstname;
    }

    public function getLastname() : string
    {
        return $this->lastname;
    }

    public function getPhone() : string
    {
        return $this->phone;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function __construct($firstname, $lastname, $email, $phone)
    {
        parent::__construct($firstname, $lastname);
        $this->phone = $phone;
        $this->email = $email;
    }

    //example
    public static function getNewCustomer() : Person
    {
        //this is called up-casting (pass more specific object to more generic)
        //return new Person("Santa", "Claus"); // fine
        return new Customer("santa", "Claus", "123456", "santa@santamail.fi");
    }
}

?>