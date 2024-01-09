<?php


namespace JOMS;

require_once (__DIR__."/Classes/Database.php");
require_once (__DIR__."/Classes/Login.php");


use Classes\Database;
use Classes\Login;
use Exception;

class processarLogin{

public function test(){

$database = new Database("localhost", "root", "", "BD_culinaria");
$database->connect();
#$database->updatePasswordHashes();

$loginHandler = new Login($database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

     #var_dump($_POST);

    try {
        $user_id = $loginHandler->processLogin($email, $password);

        if ($user_id) {
            echo "Joms";
            $loginHandler->createSession($user_id);
            header("Location: Homepage.html");
            exit();
        } else {
            echo "Dados errados. Tente novamente.";
            exit();
        }
    } catch (Exception $e) {
        echo "Ocorreu um erro durante o processamento. Tente novamente mais tarde.";
    }
} else {
    exit();
}
$database->closeConnection();
}

}

(new processarLogin())->test();

?>