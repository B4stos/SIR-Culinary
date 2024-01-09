<?php
class Database {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
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
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($usuarios as $usuario) {
            $novoHash = password_hash($usuario['password'], PASSWORD_DEFAULT);

            $updateQuery = "UPDATE Users SET password = :novoHash WHERE user_id = :userId";
            $updateStmt = $this->conn->prepare($updateQuery);
            $updateStmt->bindParam(":novoHash", $novoHash);
            $updateStmt->bindParam(":userId", $usuario['user_id']);
            $updateStmt->execute();
        }

        echo "Hashes de senha atualizados com sucesso!";
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn = null;
    }
}
?>