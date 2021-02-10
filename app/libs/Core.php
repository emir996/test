<?php 

namespace app\libs;

/**
* App Core Class
* Creates URL * loads controller
* URL FORMAT - /controller/action/params
* @package app\libs
*/

class Core {

    /**
    * Requested url
    * @var array
    */
    protected $url = [];

    /**
    * Default controller
    */
    protected $currentController = 'Home';
    /**
    *Default method
    */
    protected $currentMethod = 'index';

    /**
    *Params of url
    * @var array
    */
    protected $params = [];


    public function __construct(){

        $this->url = $this->getUrl();
        $this->getControllerAndMethodsWithParams();
        
    }

    /** get requested url */
    public function getUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode("/", $url);
            return $url;
        }
    }

    /** hit controller with right name class */
    private function getControllerAndMethodsWithParams(){
        $url = $this->url;
        // Look if exist controller
        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
            // if exist, set as controller
            $this->currentController = ucwords($url[0]);
            // Unset 0 index
            unset($url[0]);
        }

        // Require the controller
        require_once '../app/controllers/' . $this->currentController . '.php';

        // Instantiate controller class
        $class = 'App\\Controllers\\' . $this->currentController;
        $this->currentController = new $class;

        // Check if exist method in controller
        if(isset($url[1])){
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];
                // Unset 1 index
                unset($url[1]);
            }
        }

        //get params
        $this->params = $url ? array_values($url) : [];
        
        // Call a callback with parameters
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

    }
}