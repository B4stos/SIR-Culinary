<?php

namespace Controllers;

require_once (__DIR__."/../Classes/Database.php");
require_once (__DIR__."/../Classes/Receita.php");
use Classes\Database;
use Classes\Receita;


class HomePageController{

    public $database;
   

    public function __construct()
    {
         $this->database = new Database();
         $this->database->connect();
        
      
    }


    public function index(){

        $joms="A";
        $receitas = $this->database->getAllRecipes();

        
        include __DIR__."/../Pages/HomePage.php";   

    }
    
    


}


?>