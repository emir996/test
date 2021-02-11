<?php 

namespace app\controllers;

/**
* Users Class
* @package app/controller
*/

use \app\libs\Controller as BaseController;
use \app\models\User;

class Users extends BaseController {

    public function __construct(){
        $this->userModel = new User;
    }

    public function register(){
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Process form
    
          // Sanitize POST data
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  
          // Init data
          $data =[
            'name' => trim($_POST['name']),
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'confirm_password' => trim($_POST['confirm_password']),
            'name_err' => '',
            'email_err' => '',
            'password_err' => '',
            'confirm_password_err' => ''
          ];
  
          // Validate Email
          if(empty($data['email'])){
            $data['email_err'] = 'Pleae enter email';
          } else {
              //Check email
              if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err'] = 'Email already exist';
              }
          }
  
          // Validate Name
          if(empty($data['name'])){
            $data['name_err'] = 'Pleae enter name';
          }
  
          // Validate Password
          if(empty($data['password'])){
            $data['password_err'] = 'Pleae enter password';
          } elseif(strlen($data['password']) < 6){
            $data['password_err'] = 'Password must be at least 6 characters';
          }
  
          // Validate Confirm Password
          if(empty($data['confirm_password'])){
            $data['confirm_password_err'] = 'Pleae confirm password';
          } else {
            if($data['password'] != $data['confirm_password']){
              $data['confirm_password_err'] = 'Passwords do not match';
            }
          }
  
          // Make sure errors are empty
          if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
            // Validated
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            //Register User
            if($this->userModel->register($data)){
                redirect('users/login');
                flash('register_success', 'You are registered successfully');
            } else {
                die('Something went wrong');
            }
          } else {
            // Load view with errors
            $this->view('users/register', $data);
          }
  
        } else {
          // Init data
          $data =[
            'name' => '',
            'email' => '',
            'password' => '',
            'confirm_password' => '',
            'name_err' => '',
            'email_err' => '',
            'password_err' => '',
            'confirm_password_err' => ''
          ];
  
          // Load view
          $this->view('users/register', $data);
        }
      }
  
      public function login(){
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Process form
          // Sanitize POST data
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          
          // Init data
          $data =[
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'email_err' => '',
            'password_err' => '',      
          ];
  
          // Validate Email
          if(empty($data['email'])){
            $data['email_err'] = 'Pleae enter email';
          }
  
          // Validate Password
          if(empty($data['password'])){
            $data['password_err'] = 'Please enter password';
          }

          //Check for user
          if($this->userModel->findUserByEmail($data['email'])){
            // user found
          } else {
              $data['email_err'] = 'No user found';
          }
  
          // Make sure errors are empty
          if(empty($data['email_err']) && empty($data['password_err'])){
            // Validated
            // Check and set logged in user
            $loggedInUser = $this->userModel->login($data['email'], $data['password']);

            if($loggedInUser){
                // Create Session
                $this->createUserSession($loggedInUser);
            } else {
                $data['password_err'] = 'Password incorect';

                $this->view('users/login', $data);

            }
          } else {
            // Load view with errors
            $this->view('users/login', $data);
          }
  
  
        } else {
          // Init data
          $data =[    
            'email' => '',
            'password' => '',
            'email_err' => '',
            'password_err' => '',        
          ];
  
          // Load view
          $this->view('users/login', $data);
        }
      }

    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_status'] = $user->status;

        redirect('home/index');

        if($_SESSION['user_status'] == 1){
            redirect('admin/index');
        }

    }

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_status']);
        session_destroy();
        redirect('users/login');
    }

    public function isLoggedIn(){
        if(isset($_SESSION['user_id'])){
            return true;
        }
        return false;
    }

    public function isAdmin(){
        if(isset($_SESSION['user_id']) && $_SESSION['user_status'] == 1){
            return true;
        }
        return false;
    }

}