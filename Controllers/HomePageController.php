<?php

namespace Controllers;

require_once (__DIR__."/../Classes/Database.php");
require_once (__DIR__."/../Classes/Utilizador.php");
use Classes\Database;
use Classes\Utilizador;



class HomePageController{

    public $database;
   

    public function __construct()
    {
         $this->database = new Database();
         $this->database->connect();

    }


    public function index(){

        $utilizador = $_SESSION['utilizador'];
        $listareceitascard = $this->database->getReceitasCards();
        $listacategorias = $this->database->getAllCategorias();

        include __DIR__."/../Pages/HomePage.php";   

    }
    
    


}


?>