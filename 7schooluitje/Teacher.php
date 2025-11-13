<?php

namespace SchoolUitjes;

class Teacher extends Person
{
    private $salary;
    public static $teachers = [];

    public function __construct($name, $salary)
    {
        parent::__construct($name);
        $this->salary = $salary;
        $this->role();
        self::$teachers[] = $this;
    }

    public function role()
    {
        $this->role = "teacher";
    }
}