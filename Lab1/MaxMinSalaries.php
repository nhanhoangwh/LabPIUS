<?php

require_once __DIR__.'/autoload.php';

function maxSalary($deps){
    $maxSalary = 0;
    $depsWithMaxSalary = [];
    foreach($deps as $dep){
        if($maxSalary < $dep->salarySum()){
            $depsWithMaxSalary = [$dep];
        //    echo $depsWithMaxSalary[0]->getName()."\n";
            $maxSalary = $dep->salarySum();
        }
        elseif($maxSalary == $dep->salarySum()){
            array_push($depsWithMaxSalary, $dep);
        }
    }

    if(count($depsWithMaxSalary)>1){
        $maxWorkers = 0;
        foreach($depsWithMaxSalary as $dep){
            if($maxWorkers < count($dep->getEmployees())){
                $depsWithMaxSalary = [$dep];
                $maxWorkers = count($dep->getEmployees());
            }
            elseif($maxWorkers == count($dep->getEmployees())){
                array_push($depsWithMaxSalary, $dep);
            }
        }

    }
    return $depsWithMaxSalary;
}

function minSalary($deps){
    $minSalary = INF;
    $depsWithMinSalary = [];
    foreach($deps as $dep){
        if($minSalary > $dep->salarySum()){
            $depsWithMinSalary = [$dep];
            $minSalary = $dep->salarySum();
        }
        elseif($minSalary == $dep->salarySum()){
            array_push($depsWithMinSalary, $dep);
        }
    }

    if(count($depsWithMinSalary)>1){
        $maxWorkers = 0;
        foreach($depsWithMinSalary as $dep){
            if($maxWorkers < count($dep->getEmployees())){
                $maxWorkers = count($dep->getEmployees());
                $depsWithMinSalary = [$dep];
            }
            elseif($maxWorkers == count($dep->getEmployees())){
                array_push($depsWithMinSalary, $dep);
            }
        }

    }
    return $depsWithMinSalary;
}