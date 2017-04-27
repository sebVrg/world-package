<?php

namespace FindCode\Api\Model;



use Lib\MVC\AbstractSubject;
use Lib\MVC\SubjectInterface;
use RuntimeException;

class PackageModel extends AbstractSubject implements
    SubjectInterface,
    PackageModelInterface
{
    
    /**
     * 
     * @var unknown $name
     * @var unknown $package
     * @var unknown $keywords
     * @var unknown $license
     * @var unknown $authors
     * @var unknown $version
     * @var unknown $langage
     * @var unknown $use
     */
    public
    $distribuable,
    $type,
    $testable,
    $name,
    $package,
    $homepage,
    $keywords,
    $license,
    $author,
    $version,
    $langage,
    $devDependencies,
    $dependencies,
    $use;
    
    
   
    
    
    
    public function __construct()
    {
        parent::__construct();
        $this->distribuable = false;
        $this->testable = false;
        $this->type = "library";
        $this->version=[];
        $this->name= "";
        $this->package = "";
        $this->homepage = "";
        $this->keywords  = [];
        $this->license = "";
        $this->author = "";
        $this->devDependencies = [];
        $this->dependencies = [];
        
        
    }
    private function consumTravis()
    {
        $url= "https://raw.githubusercontent.com/" . $this->package
        ."/master/.travis.yml";
 
       $this->testable =  $this->consum($url, true);

        
    }
    /**
     * 
     * @return boolean
     */
    private function consumPackage()
    {
        $url ="https://raw.githubusercontent.com/" .  $this->package . 
        "/master/package.json";
        
        $obj = $this->consum($url);

        if ($obj) {
            
            $this->langage = "js";
            $this->setAttribute($obj);
            
            if(isset($obj->version) && is_string($obj->version)) {
                $this->version[] = $obj->version;
            }
            var_dump($obj->version);
            if (isset($obj->devDependencies)
             && is_object($obj->devDependencies)) {
                $this->use = $obj->devDependencies;
            }
            if (isset($obj->Dependencies)
                && is_object($obj->Dependencies)) {
                    $this->use = $obj->Dependencies;
                }
            if (isset($obj->author)) {
                $this->author = $obj->author;
            }
           

            if (isset($obj->keywords)
                 && is_array($obj->keywords))
            { 
                     foreach ($obj->keywords as $key => $value) 
                     {
                  
                        $this->keywords =$obj->keywords;
                      }
           
              }
            
                 $this->consumNpm();                            
                return true;                            
          }
            return false;

       }
            
       
        
    
    private  function consumPackagist() 
    {

        $url="https://packagist.org/packages/" . $this->package . ".json";
        $obj = $this->consum($url);
        
        
        $this->distribuable =(bool) $this->consum($url,true);
        if ($obj) {
            
            foreach ($obj->package->versions as $key => $value) {
                $this->version[] = $key;
            }
        }
        
    }
    
    private function consumNpm()
    {
       $url = "https://www.npmjs.com/package/" .$this->name;
       $this->distribuable = (bool) $this->consum($url, true);
    }
    /**
     * 
     * @return boolean
     */
    private function consumComposer () 
    {
        $url ="https://raw.githubusercontent.com/" .  $this->package .
        "/master/composer.json";
        $obj = $this->consum($url);
        if ($obj) {
            $this->langage = "php";
            $this->setAttribute($obj);
            $this->distribuable = true;
            
            if (isset($obj->require)  && is_object($obj->require)) {
                $this->use = $obj->require;
            }
            if (isset($obj->authors)
                && is_array($obj->authors)
                && array_key_exists(0, $obj->authors)
                && isset($obj->authors[0]->name)) {
                   $this->author = $obj->authors[0]->name;
            }

            
           
            $this->consumPackagist();
            return true;
        }
        return false;  
      }

    /**
     * 
     * @param unknown $url
     * @return mixed
     */
    private function consum($url, $ping = false)
    {
        $filename= __DIR__ . "/cache/" . md5($url);
        
//         if (file_exists($filename)) {
//             $output = file_get_contents($filename);
            
//         } else {
            $code= "404";
            $output = @file_get_contents($url);
            if (isset($http_response_header)) {
                $tab = explode(" ", $http_response_header[0]);
            $code= $tab[1];
//             }
            
            
            
            
            
            if ($code === "200") {
//                 file_put_contents($filename, ($ping ? $url : $output));
            } else {
                $ping = false;
            }
        }
        return $ping ? $ping : json_decode($output);
    }
    /**
     * 
     * @throws RuntimeException
     */
    public function get()
    {
        if (!$this->consumPackage()
         && !$this->consumComposer()) {
            throw new RuntimeException();
        }
        
    }

    public function setAttribute($obj)
    {
        if (isset($obj->name)) {
            $this->name = $obj->name;
        }
        
        $this->description = isset($obj->description) ? (string) $obj->description : "";
        
        $this->license = isset($obj->licence) ? (string) $obj->licence : "MIT";
        
        $this->homepage = isset($obj->homepage) ? (string) $obj->homepage : "";
        
        if (isset($obj->keywords)
            && is_array($obj->keywords)) {
            
                $this->keywords =$obj->keywords;
        }
        $this->consumTravis();
         


        
    }
    
    
}