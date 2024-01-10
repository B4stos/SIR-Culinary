<?php


namespace Controllers;

require_once (__DIR__."/../Classes/Database.php");
require_once (__DIR__."/../Classes/Login.php");


use Classes\Database;
use Classes\Login;
use Exception;

class ProcessarLoginController{

    public $database;

    public function __construct()
    {
         $this->database = new Database();
         $this->database->connect();
    }


public function processologin(){

$loginHandler = new Login($this->database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

     #var_dump($_POST);

    try {
        $user_id = $loginHandler->processLogin($email, $password);

        if ($user_id) {
            $loginHandler->createSession($user_id);
            header("Location: homepage.php");
            exit();
        } else {
            echo "Dados errados. Tente novamente.";
            exit();
        }
    } catch (Exception $e) {
        echo "Ocorreu um erro durante o processamento. Tente novamente mais tarde.";
    }
}
$this->database->closeConnection();
}

}

?>