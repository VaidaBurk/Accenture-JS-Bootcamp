<?php

class Person {

    protected string $firstname;
    protected string $lastname;

    public function getFirstname() : string
    {
        return $this->firstname;
    }

    public function getLastname() : string
    {
        return $this->lastname;
    }

    public function __construct(string $firstname, string $lastname) 
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }
}