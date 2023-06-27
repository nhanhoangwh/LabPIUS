<?php
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\ValidatorBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

require_once __DIR__.'/autoload.php';

echo "---Task 1---\n";

$date = new DateTime('2001-01-01'); 
$em1 = new Employee($date,"sdfg","IncorrectEmployee",150000000);
$em2 = new Employee("Wednesday 2001",15,"IncorrectEmployee",150);
$em3 = new Employee($date,21,"CorrectEmployee",200);
$em6 = new Employee($date,21,"CorrectEmployee",350);

$employees = [$em1, $em2, $em3];

foreach($employees as $employee){
    $employee->validate();
}

echo "---Task 2---\n";

$em4 = new Employee($date,21,"CorrectEmployee",250);
$em5 = new Employee($date,21,"CorrectEmployee",100);
$em6 = new Employee($date,21,"CorrectEmployee",350);

$depList1 = [$em3, $em6 ];
$depList2 = [$em3, $em4, $em5];
$depList3 = [$em3, $em5];


$dep1 = new Departament($depList1, "Dep1");
$dep2 = new Departament($depList2, "Dep2");
$dep3 = new Departament($depList3, "Dep3");

echo "Sum salary of first departament is ".$dep1->salarySum()."\n";
echo "Sum salary of second departament is ".$dep2->salarySum()."\n";

$deps = [];
array_push($deps,$dep1,$dep2,$dep3);

$depsWithMaxSalary = maxSalary($deps);
echo "Deps with max salary - ";
foreach($depsWithMaxSalary as $dep){
    echo $dep->getName()."\n";
}

echo "Deps with min salary - ";
$depsWithMinSalary = minSalary($deps);
foreach($depsWithMinSalary as $dep){
    echo $dep->getName()."\n";
}
?>
