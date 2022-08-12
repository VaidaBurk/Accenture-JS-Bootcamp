<?php

abstract class Shape
{
    protected $base;
    protected $height;

    public function __construct($edge1, $edge2)
    {
        $this->base = $edge1;
        $this->height = $edge2;
    }

    abstract public function surface() : float; // functions can't be private in abstract classes. They must be overrided in subclasses
    
    public function showSurface()
    {
        echo $this->surface();
    }

    public abstract function getPerimeter() : float;

    public static function getInstance() : Shape
    {
        $arguments = func_get_args();
        if (isset($arguments[0]) && isset($arguments[1]) && !isset($arguments[3])){
            return new Rectangle($arguments[0], $arguments[1]);
        }
        else if (isset($arguments[3])){
            return new Triangle($arguments[0], $arguments[1], $arguments[2]);
        }
    }
}

class Triangle extends Shape
{
    protected float $edge3;

    public function surface() : float
    {
        $sP = $this->getPerimeter() / 2;
        $sPRootUnder = $sP * ($sP - $this->base) * ($sP - $this->height) * ($sP - $this->edge3);
        return round((sqrt($sPRootUnder)), 2);
    }

    public function __construct($edge1, $edge2, $edge3)
    {
        parent::__construct($edge1, $edge2);
        $this->edge3 = $edge3;
    }

    public function getPerimeter () : float
    {
        return $this->edge1 + $this->edge2 + $this->edge3;
    }

}

class Rectangle extends Shape
{
    public function surface() : float
    {
        return round(($this->base) * ($this->height), 2);
    }

    public function getPerimeter () : float
    {
        return 2 * $this->edge1 + 2 * $this->edge2;
    }
}

