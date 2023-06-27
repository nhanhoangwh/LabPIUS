<?php

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Translation\MessageSelector;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Mapping\ClassMetadata;

require_once __DIR__.'/autoload.php';

class Employee{
   
    protected $id;
    protected $name;
    protected $salary;
    protected $employment_date;

    public function __construct($employment_date, $id = 1111, $name = "employername", $salary = 100){
        $this->id = $id;
        $this->name = $name;
        $this->salary = $salary;
        $this->employment_date = $employment_date;
    }

    public function getId(){
       return $this->id;
    }

    public function getName(){
      return $this->name;
   }

   public function getSalary(){
      return $this->salary;
   }

   public function getEmploymentDate(){
      return $this->employment_date->format('Y-m-d');
   }

   public function getExp(){
      $now = new DateTime();
      $exp = $now->diff($this->employment_date);
      return $exp->y;
   }

   public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('id', new Assert\NotBlank());
        $metadata->addPropertyConstraint('id', new Assert\Range([
         'min' => 1,
         'max' => 9999,
         'notInRangeMessage' => 'Id must be between {{ min }} and {{ max }}',
         ]));
         $metadata->addPropertyConstraint('name', new Assert\NotBlank());
         $metadata->addPropertyConstraint('name', new Assert\Regex([
            'pattern' => '/^[a-z]+$/i',
            'htmlPattern' => '[a-zA-Z]+',
         ]));
         $metadata->addPropertyConstraint('name', new Assert\Regex([
            'pattern' => '/\d/',
            'match' => false,
            'message' => 'Your name cannot contain a number',
        ]));
        $metadata->addPropertyConstraint('name', new Assert\Length([
         'min' => 2,
         'max' => 50,
         'minMessage' => 'Your name must be at least {{ limit }} characters long',
         'maxMessage' => 'Your name cannot be longer than {{ limit }} characters',
        ]));
        $metadata->addPropertyConstraint('salary', new Assert\Range([
         'min' => 1,
         'max' => 1000,
         'notInRangeMessage' => 'Salary must be between {{ min }} and {{ max }}',
         ]));
         $metadata->addPropertyConstraint('employment_date', new Assert\Type("\DateTimeInterface"));
    }

    public function validate(){
      $validator = Validation::createValidatorBuilder()->addMethodMapping('loadValidatorMetadata')->getValidator();

      $errors = $validator->validate($this);
      echo count($errors)."\n";
      
      if (0 !== count($errors)) {
          echo $this->name." Employee is not valid\n";
          foreach ($errors as $violation) {
              echo $violation->getMessage()."\n";
          }
      }
      else{
          echo $this->name." Employee is valid\n";
      }
    }
}
?>