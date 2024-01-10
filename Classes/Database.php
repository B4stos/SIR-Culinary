<?php

namespace Classes;


require_once (__DIR__."/../Config/ConfigDB.php");
use Config\ConfigDB;
use PDO;
use PDOException;



class Database {
    
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;
    private $configDB;

    public function __construct() {
        $this->configDB = new ConfigDB();
        $this->servername = $this->configDB->server;
        $this->username = $this->configDB->username;
        $this->password = $this->configDB->password;
        $this->dbname = $this->configDB->database;
    }

    public function connect() {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Conexão com o banco de dados estabelecida com sucesso";
        } catch(PDOException $e) {
            echo "Conexão falhou: " . $e->getMessage();
        }
    }

    public function updatePasswordHashes() {
        $query = "SELECT user_id, password FROM Users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $utilizadores = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($utilizadores as $utilizador) {
            $novoHash = password_hash($utilizador['password'], PASSWORD_DEFAULT);

            $updateQuery = "UPDATE Users SET password = :novoHash WHERE user_id = :userId";
            $updateStmt = $this->conn->prepare($updateQuery);
            $updateStmt->bindParam(":novoHash", $novoHash);
            $updateStmt->bindParam(":userId", $utilizador['user_id']);
            $updateStmt->execute();
        }

        echo "Hashes de senha atualizados com sucesso!";
    }

    public function getAllRecipes() {
        $query = "SELECT * FROM Receitas";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $receitasData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $receitas = [];

        foreach ($receitasData as $receitaData) {
            $receitas[] = new Receita(
                $receitaData['receita_id'],
                $receitaData['titulo'],
                $receitaData['modo_preparo'],
                $receitaData['data_preparo'],
                $receitaData['user_id']
            );
        }

        return $receitas;
    }

    public function getAllAnexos() {
        $query = "SELECT * FROM Anexos";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $anexosData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
       
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn = null;
    }
}
?>