<?php
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

require_once __DIR__.'/autoload.php';

class Departament{
    protected $name;
    protected $employees;

    public function __construct($employees, $name){
        $this->employees = $employees;
        $this->name = $name;
    }

    public function salarySum(){
        $sum = 0;
        foreach($this->employees as $emp){
            $sum += $emp->getSalary();
        }
        return $sum;
    }

    public function getEmployees(){
        return $this->employees;
    }

    public function getName(){
        return $this->name;
    }
}

?>