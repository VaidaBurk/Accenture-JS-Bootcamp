<?php

interface IShape
{
    public function surface() : float;
    public function showSurface();
    Public function getPerimeter() : float;
}

interface IDisplayable
{
    public function show();
}

class ShapeGenerator
{
    public static function getInstance() : IShape
    {
        $arguments = func_get_args();
        if (isset($arguments[0]) && isset($arguments[1]) && !isset($arguments[3])){
            return new Rectangle1($arguments[0], $arguments[1]);
        }
        else if (isset($arguments[3])){
            return new Triangle1($arguments[0], $arguments[1], $arguments[2]);
        }
    }
}

class Triangle1 implements IShape, IDisplayable
{
    protected float $edge1, $edge2, $edge3;

    public function show()
    {
        echo "This is the triangle";
    }

    public function surface() : float
    {
        $sP = $this->getPerimeter() / 2;
        $sPRootUnder = $sP * ($sP - $this->base) * ($sP - $this->height) * ($sP - $this->edge3);
        return round((sqrt($sPRootUnder)), 2);
    }

    public function getPerimeter () : float
    {
        return $this->edge1 + $this->edge2 + $this->edge3;
    }

    public function showSurface()
    {
        echo $this->surface();
    }
}

class Rectangle1 implements IShape, IDisplayable
{
    protected float $height, $base;

    public function __construct($height, $base)
    {
        $this->height = $height;
        $this->base = $base;
    }

    public function showSurface()
    {
        echo $this->surface();
    }

    public function surface() : float
    {
        return round(($this->base) * ($this->height), 2);
    }

    public function getPerimeter () : float
    {
        return 2 * $this->edge1 + 2 * $this->edge2;
    }

    public function show()
    {
        echo "This is rectangle with height " . $this->height . "and base " . $this->base;
    }
}