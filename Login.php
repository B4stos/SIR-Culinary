<?php

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
    
        // var_dump($result);

        if ($result) {
            $storedPassword = $result['password'];

            if (password_verify($password, $storedPassword)) {
                return true; 
            }
        }
    
        return false; 
    }
}

?>