<?php

namespace Controllers;

require_once (__DIR__."/../Classes/Database.php");
require_once (__DIR__."/../Classes/Receita.php");
use Classes\Database;



class HomePageController{

    public $database;
   

    public function __construct()
    {
         $this->database = new Database();
         $this->database->connect();

    }


    public function index(){

        $joms="A";
        $listareceitascard = $this->database->getReceitasCards();
        $listacategorias = $this->database->getAllCategorias();
        
        include __DIR__."/../Pages/HomePage.php";   

    }
    
    


}


?>