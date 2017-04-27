<?php

namespace FindCode\Api\Controller;



use FindCode\api\Model\PackageModel;
use FindCode\api\View\PackageView;
use RuntimeException;

class PackageController implements PackageControllerInterface{
    
    private 
    
    $model,
    
    $view;
    
    public function __construct (PackageModel $model, PackageView $view) {
        $this->model = $model;
        $this->view = $view;
        $this->model->register($this->view);
    }
    
    public function execute() {
        try {         //filtre de données entrantes (2 args)
            $method = strtolower(filter_input(INPUT_SERVER, "REQUEST_METHOD"));
            // verification de l'existence//-impose method get et la reformate
            if (method_exists($this->model, $method)) {
                $package = strtolower(filter_input(INPUT_GET, "package"));
                if ($package) {
                    $this->model->package= $package;
                    $this->model->{$method}();
                    
                } else {
                    header("HTTP/1.1 412 Method Not Allowed");
                    return ' { "error": "Expect input package" }';
                }
            } else {
                header("HTTP/1.1 405 Method Not Allowed");
                return ' { "error": "Expect get method" }';
            }
        }  catch (RuntimeException $e) {
            header("HTTP/1.1 404 Not Found");
            return ' { "error": "Package no found" }';
        } catch (Throwable $e) {
            header("HTTP/1.1 500 Internal Server Error");
            return ' { "error": "Unexpect error" }';
        }
        $this->view->update($this->model);
        return $this->view->render();
    }

}
