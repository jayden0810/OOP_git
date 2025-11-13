<?php

namespace Schooltrip;

class Group
{
    private $groupname;
    private $group = [];
    public function __construct($groupname)
    {
        $this->groupname = $groupname;
    }

    public function addStudent($student)
    {
        $this->group[] = $student;
    }

    public function getGroup()
    {
        return $this->group;
    }

    public function getGroupname()
    {
        return $this->groupname;
    }
}