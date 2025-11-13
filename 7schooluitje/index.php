<?php

require_once "vendor/autoload.php";

use Schooltrip\Person;
use Schooltrip\Teacher;
use Schooltrip\Student;
use Schooltrip\Group;
use Schooltrip\Schooltrip;

// Maakt de groepen aan
$group = new Group("SOD2A");
$group2 = new Group("SOD2B");

// Maak studenten aan
$student1 = new Student("Jan", $group);
$student2 = new Student("Piet", $group, true, true);
$student3 = new Student("Klaas", $group2, true, true);
$student4 = new Student("Marie", $group2, true, true);
$student5 = new Student("Sofie", $group, true);
$student6 = new Student("Lotte", $group2, true, true);
$student7 = new Student("Eva", $group2);
$student8 = new Student("Sara", $group, true, true);
$student9 = new Student("Tom", $group, true, true);
$student10 = new Student("Lucas", $group, true, true);

// Maak leraren aan
$teacher1 = new Teacher("Jansen", 10000);
$teacher2 = new Teacher("De Vries", 12000);
$teacher3 = new Teacher("Van den Berg", 11000);
$teacher4 = new Teacher("Bakker", 13000);

// Maak schooluitje aan naar de Efteling
$schooltrip = new Schooltrip("Efteling");

//voegt personen toe aan het schooluitje
/*
$schooltrip->addPerson($student1);
$schooltrip->addPerson($student2);
$schooltrip->addPerson($student3);
$schooltrip->addPerson($student4);
$schooltrip->addPerson($student5);
$schooltrip->addPerson($student6);
$schooltrip->addPerson($student7);
$schooltrip->addPerson($student8);
$schooltrip->addPerson($student9);
$schooltrip->addPerson($student10);
*/

// Dynamish alle studenten toevoegen
foreach ([$student1, $student2, $student3, $student4, $student5, $student6, $student7, $student8, $student9, $student10] as $student) {
    $schooltrip->addPerson($student);
}



// haalt de lijst van schoolreizen op
$schooltrip->getSchooltripList();

// Start het genereren van een HTML-tabel voor de schooluitjes
print "<pre>";
// var_dump($schooltrip); // Gecommenteerd: zou de volledige structuur van het schooluitje tonen

print "table border='1'>
        <thead>
            <tr>
                <th>Docent</th>
                <th>Student</th>
                <th>Klas</th>
                <th>Betaald</th>
            </tr>
        </thead>";
        // hier wordt de tablekop gedefinieerdmet kolomnamen
foreach ($schooltrip->getSchooltripList() as $schooltripList) {
    $students = $schooltripList->getStudentList();
print "<tr>";
//toont de namen van de docenten
print "<td>" .$schooltripList->getTeacher()->getName() . "</td>";
    "<td></td>
    <td></td>
    <td></td>;
    ";
    print "</tr>";

    //hier worden de studenten per docent getoond


    foreach ($students as $student) 
    {
        print "<tr>";
              "<td></td>;
        <td>" . $student->getName() . "</td>;
        <td>" . $student->getClassname()->getGroupname() . "</td>;
        <td>" . $student->getPaid() . "</td>;
        ";
        print "</tr>";
    }
}
print "</table>";