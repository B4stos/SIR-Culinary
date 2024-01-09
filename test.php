<?php

include 'Utilizador.php';
include 'Database.php';


$Database = new Database("localhost","root","","BD_culinaria");


$Database->connect();
$conn = $Database->getConnection();

$sql = "SELECT * FROM Users";
$result = $conn->query($sql);

if ($result->rowCount() > 0) {
    // Exibir os resultados
    echo "<table border='1'>";
    echo "<tr><th>User ID</th><th>First Name</th><th>Last Name</th><th>Email</th></tr>";
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>{$row['user_id']}</td>";
        echo "<td>{$row['first_name']}</td>";
        echo "<td>{$row['last_name']}</td>";
        echo "<td>{$row['email']}</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "ike";
} else {
    echo "Nenhum usuário encontrado na tabela Users.";
}

?>
