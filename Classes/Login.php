<?php

namespace Classes;
require_once (__DIR__."/Utilizador.php");
use Classes\Utilizador;
use PDO;


class Login {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }


    public function processLogin($email, $password) {
        $query = "SELECT user_id, password FROM Users WHERE email = :email LIMIT 1";
        $stmt = $this->database->getConnection()->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        #var_dump($result);

        if ($result) {
            $storedPassword = $result['password'];

            if (password_verify($password, $storedPassword)) {
                return $result['user_id'];
            }
        }
    
        return false; 
    }

    public function createSession($user_id) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $userData = $this->getInfoUser($user_id);

        $utilizador = new Utilizador(
            $userData['user_id'],
            $userData['first_name'],
            $userData['last_name'],
            $userData['notificacao'],
            $userData['email'],
            $userData['imagem'],
            $userData['telefone']
        );

        $utilizador->setDefaultImagemUsuario();
        
        $_SESSION['utilizador'] = $utilizador;
    }
    
    private function getInfoUser($user_id) {
        $query = "SELECT * FROM Users WHERE user_id = :user_id LIMIT 1";
        $stmt = $this->database->getConnection()->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

}

?>