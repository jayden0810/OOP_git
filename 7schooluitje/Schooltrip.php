<?php

namespace Schooltrip;
use Schooltrip\SchooltripList;

class Schooltrip{
    private $name;
    private $student;
    private $schooltripList = [];
    private static $countStudent = 0;
    private static $countList = -1;
    private static $ammount = 3;

    public function __construct($name){
        $this->name = $name;}

        public function addSchooltripList()
        {
            $this->schooltripList[] = new SchooltripList();
            Schooltrip::$countList++;
            $this->schooltripList[self::$countList]->setTeacher(Teacher::$teachers[self::$countList]);
        }
public function addStudent($student){
    if (Schooltrip::$countStudent == 0 || Schooltrip::$countStudent % self::$ammount == 0) 
    {
        $this->addSchooltripList();
    }
  
    $this->schooltripList[self::$countList]->addStudentToList($student);
    self::$countStudent++;
}
public function getSchooltripList(){
    return $this->schooltripList;
}
}