<?php

namespace app\controllers;

/**
* Admin Class
* @package app\controllers
*/

use \app\libs\Controller as BaseController;
use \app\models\Product;


class Admin extends BaseController {

    public function __construct(){
        $this->productModel = new Product();
    }

    public function index(){
        
        $products = $this->productModel->getAll();
        
        $data = ['title' => 'List of Products', 'subtitle' => 'Create New product', 'products' => $products];
        
        $this->view('admin/index', $data);
        
    }

    public function create(){

        $data = ['subtitle' => 'Create Product'];


        $this->view('admin/create', $data);
    }

    public function store(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if(isset($_FILES['image'])){
                $name = $_FILES['image']['name'];
                $target_dir = '../app/upload/';
                $target_file = $target_dir . basename($_FILES["image"]["name"]);

                // Select file type
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                // Valid file extensions
                $extensions_arr = array("jpg","jpeg","png","gif");

                // Check extension
                if( in_array($imageFileType,$extensions_arr) ){
                    // Upload file
                    move_uploaded_file($_FILES['image']['tmp_name'],$target_dir.$name);
                }
            } 

            if($name == ""){
                $name = "noimage.png";
            }

            die($name);
    
            $data = [
              'title' => trim($_POST['title']),
              'description' => trim($_POST['description']),
              'title_err' => '',
              'image' => $name,
              'description_err' => ''
            ];
    
            // Validate data
            if(empty($data['title'])){
              $data['title_err'] = 'Please enter title';
            }
            if(empty($data['description'])){
              $data['description_err'] = 'Please enter description text';
            }
    
            // Make sure no errors
            if(empty($data['title_err']) && empty($data['description_err'])){
              // Validated
              die('success');
            } else {
              // Load view with errors
              $this->view('posts/create', $data);
            }
    
          } else {
            $data = [
              'title' => '',
              'description' => ''
            ];
      
            $this->view('admin/create', $data);
          }
        
        // if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //     // Process form
      
        //     // Sanitize POST data
        //     $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            
    
        //     //Init data
        //     $data =[
        //       'title' => trim($_POST['title']),
        //       'description' => trim($_POST['description']),
        //       'image' => $name,
        //       'title_err' => '',
        //       'description_err' => ''
              
        //     ];
    
        //     // Validate title
        //     if(empty($data['title'])){
        //       $data['title_err'] = 'Pleae enter title';
        //     } 
    
        //     // Validate Name
        //     if(empty($data['description'])){
        //       $data['description_err'] = 'Please enter description';
        //     }
    
        //     // Make sure errors are empty
        //     if(empty($data['title_err']) && empty($data['description_err'])){
        //       // Validated
  
        //       //Register User
        //       echo 'yeee';
        //     } else {
        //       // Load view with errors
        //       $this->view('admin/create', $data);
        //     }
    
        //   } else {
        //     // Init data
        //     $data =[
        //       'title' => '',
        //       'description' => '',
        //       'title_err' => '',
        //       'description_err' => ''
        //     ];
    
        //     // Load view
        //     $this->view('admin/create', $data);
          
        // }
    }

    public function edit($id){
        $data = ['title' => 'Edit Product', 'id' => $id];

        $this->view('admin/edit', $data);
    }

}