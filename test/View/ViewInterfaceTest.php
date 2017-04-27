<?php

namespace FindCode\Test\View;


use FindCode\Api\View\ViewInterface;
use Lib\MVC\AbstractSubject;
use Lib\MVC\SubjectInterface;


abstract class ViewInterfaceTest extends \PHPUnit\Framework\TestCase
 
{
    abstract public  function  getViewInterface() : ViewInterface;
    /**
     * 
     * testInstanceofViewInterface
     */
    public function testInstanceofViewInterface()
    {
        
        $this->assertTrue(
        $this->getViewInterface() instanceof ViewInterface); 
    }
    /**
     * testMethods
     */
    public function testMethods()
    {
        
        $mock= $this->getViewInterface();
        $this->assertTrue(
              method_exists($mock, "render")
          &&  method_exists($mock, "update")
            );
        
    }
    /**
     * @expectedException TypeError
     */
    public function testTypeError()
    {
        $this->getViewInterface()
        ->update("Dummy");
    }
    
    /**
     *
     * test render
     */
    public function testRenderJsonOnly()
    {
        $mock = $this->getViewInterface();
        $this->assertTrue(
            is_string($mock->render())
         && json_decode($mock->render()) instanceof \stdClass
       ); 
    }
    
    /**
     * 
     * test Update
     */
    public function testUpdate()
    {
           $subjectMock = (new \ReflectionClass(DummyTst::class))
                            ->newInstance([]);
           $mock = $this->getViewInterface();
           $mock->update($subjectMock);
           $obj = json_decode($mock->render()); 
           
           $this->assertTrue(
               property_exists($obj, "bar")
               && $obj->bar === "bar"
               );
               
    }
    
}
class DummyTst extends AbstractSubject implements SubjectInterface
{
    public $bar = "bar";
    
    public function  __construct()
    {
        parent::__construct();
    }
}