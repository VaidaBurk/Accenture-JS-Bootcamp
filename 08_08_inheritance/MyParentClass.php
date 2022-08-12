<?php

class MyParentClass
{
    private string $str1, $str2;

    public function __construct($str1, $str2)
    {
        $this->str1 = $str1;
        $this->str2 = $str2;
    }

    public function showProperties()
    {
        echo $this->str1 . " " . $this->str2;
    }

    // final functions can't be override. Final classes can't be extended
    final public function accessPrivateElements($str1, $str2)
    {
        $this->str1 = $str1;
        $this->str2 = $str2;
    }
}

class MySubClass extends MyParentClass
{
    private string $str3;

    public function __construct($str1, $str2, $str3)
    {
        parent::__construct($str1, $str2);
        $this->str3 = $str3;
    }

    // overriding
    public function showProperties()
    {
        parent::showProperties();
        echo " " . $this->str3;
    }
}