<?php 

namespace app\controllers;

/** 
* class Home Controller
* @package app\controllers
*/

use \app\libs\Controller as BaseController;
use \app\models\Product;

class Home extends BaseController{

    public function __construct(){
        $this->productModel = new Product();
    }

    public function index(){

        $data = ['title' => 'Welcome main page'];

        $this->view('home/index', $data);
    }
    

    public function about(){
        $this->view('home/about', ['title' => 'Welcome about page']);
    }
}