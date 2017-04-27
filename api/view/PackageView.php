<?php

namespace FindCode\Api\View;



use Lib\MVC\ObserverInterface;
use Lib\MVC\SubjectInterface;


class PackageView implements ObserverInterface, ViewInterface
{
    
    private $template;
    
    public function __construct() 
    {
        $this->template="{}";     
    }
    
    public function update(SubjectInterface $subject)
    {
        $this->template = json_encode($subject ,JSON_PRETTY_PRINT);
        
    }
    
    
    public function render()
    {
        return $this->template;
    }
    
    
}