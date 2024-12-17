<?php
class BaseController {
    protected $model;
    protected $view;
    
    public function loadModel($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }
    
    public function view($view, $data = []) {
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        }
    }
}
