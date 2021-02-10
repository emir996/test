<?php

namespace app\models;
use \app\libs\Database;

/**
* class with our products
* @package app\models;
*/

class Product {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    
}