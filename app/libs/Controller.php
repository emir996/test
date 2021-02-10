<?php 

namespace app\libs;

/**
* Base Controller
* Loads the models and views
* @package app\libs
*/
class Controller {
    // Load model
    public function model($model){
        // Require model file
        require_once '../app/models/' . $model . '.php';

        return new $model();
    }

    //Load view
    public function view($view, Array $data = []){
        //Check for view file
        if(file_exists('../app/views/' . $view . '.php')){
            require_once '../app/views/' . $view . '.php';
        } else {
            require_once '../app/views/404.php';
        }
    }
}