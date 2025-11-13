<?php

namespace Schooltrip;

abstract class Person
{
    private $name;
    protected $role;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    abstract public function role();
}