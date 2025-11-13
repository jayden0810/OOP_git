<?php

namespace SchoolUitjes;

class Student extends Person
{
    private $classname;
    private $paid;
    private $join;

    public function __construct($name, $classname, $join = false, $paid = false)
    {
        parent::__construct($name);
        $this->classname = $classname;
        $this->join = $join;
        $this->paid = $paid;
        $this->role();
    }
    public function setJoin()
    {
        $this->join = true;
    }

    public function removeJoin()
    {
        $this->join = false;
    }

    public function setPaid()
    {
        $this->paid = true;
    }

    public function getClassname()
    {
        return $this->classname;
    }

    public function removePaid()
    {
        $this->paid = false;
    }

    public function getJoin()
    {
        return $this->join;
    }

    public function getPaid()
    {
        return $this->paid ? "ja" : "nee";
    }

    public function role()
    {
        $this->role = "student";
    }

    public function getRole()
    {
        parent::getRole();
    }

    public function getStudent()
    {
        return $this;
    }
}