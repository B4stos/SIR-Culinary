<?php
include 'Login.php';
include 'Database.php';

$database = new Database("localhost", "root", "", "BD_culinaria");
$database->connect();
$database->updatePasswordHashes();

$loginHandler = new Login($database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // var_dump($_POST);

    try {
        if ($loginHandler->processLogin($email, $password)) {
            echo "JOMS";
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
?>