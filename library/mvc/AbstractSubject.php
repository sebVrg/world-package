<?php

namespace Lib\MVC;

abstract class AbstractSubject
{
    protected 
    /**
     * @var ObserverInterface observer
     */
    $observer;
     
    
    
    protected function __construct()
    {
         $this->observer=[];
    }
    /**
     * Register observer
     * Add an observer for notification
     *
     * @param ObserverInterface $observer
     */
    
    public function register(ObserverInterface $observer)
    {
      $this->observer[]= $observer;   
    }
    
    /**
     * Unregister observer
     * Remove an observer of notifications
     *
     * @param ObserverInterface $observer
     */
    
    public function unregister(ObserverInterface $observer)
    {
        $key= array_search($observer, $this->observer);
        
        if (is_int($key)) {
            unset($this->observer[$key]);
        }
    }
    /**
     * Notify observer
     * update observer collection
     */
    public function notify()
    {
        foreach ($this->observer as $observer) { //maj des observers
            $observer->update($this);
        }
    }
    
}