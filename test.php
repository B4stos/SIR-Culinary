<?php

require_once(__DIR__ . "/Classes/Utilizador.php");
use Classes\Utilizador;
require_once(__DIR__ . "/classes/Database.php");
use Classes\Database;

class test
{

    public $database;

    public function __construct()
    {
        $this->database = new Database();
        $this->database->connect();
    }

    public function testbasededados()
    {

        #$this->database->updatePasswordHashes();

        $result = "SELECT * FROM Users";
        $stmt = $this->database->getConnection()->prepare($result);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Exibir os resultados
            echo "<table border='1'>";
            echo "<tr><th>User ID</th><th>First Name</th><th>Last Name</th><th>Email</th></tr></th><th>password</th></tr>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>{$row['user_id']}</td>";
                echo "<td>{$row['first_name']}</td>";
                echo "<td>{$row['last_name']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['password']}</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Nenhum usuário encontrado na tabela Users.";
        }
    }
}

$tester = new test();
$tester->testbasededados();
$status = session_status();

if ($status == PHP_SESSION_ACTIVE) {
    echo "A sessão está ativa.";
} elseif ($status == PHP_SESSION_NONE) {
    echo "A sessão está habilitada, mas não existe.";
} elseif ($status == PHP_SESSION_DISABLED) {
    echo "As sessões estão desabilitadas.";
}
?>
