<?php

namespace FindCode\Test\Model;



use FindCode\Api\Model\PackageModelInterface;
use ReflectionClass;
use FindCode\Api\Model\PackageModel;


class PackageModelTest extends PackageModelInterfaceTest

{
    
    public function getPackageModelInterface(): PackageModelInterface
    {
        //reflective class
        return (new \ReflectionClass(PackageModel::class))->newInstanceArgs([]);
        
       
    }
    
    
}
