<?php

namespace FindCode\Test\View;


use FindCode\Api\View\ViewInterface;
use FindCode\Api\View\PackageView;
use ReflectionClass;


class PackageViewTest extends ViewInterfaceTest

{
   
    public function getViewInterface(): ViewInterface
    {
        //reflective class
       return (new \ReflectionClass(PackageView::class))
       //obtention de l'instance
              ->newInstanceArgs([]); 
    }
}