<?php
require_once (__DIR__."/../Classes/Database.php");
use Classes\Database;

try {
    $database = new Database();
    $database->connect();

    if (isset($_GET['id_categoria'])) {
        $idCategoria = $_GET['id_categoria'];

        $receitas = $database->getReceitaCardCategoria($idCategoria);

        error_log(print_r($receitas, true));
        error_log(gettype($receitas));

        if (empty($receitas)) {
            header('HTTP/1.1 404 Not Found');
            echo json_encode(['error' => 'Nenhuma receita encontrada.']);
        } else {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($receitas, JSON_UNESCAPED_UNICODE);
        }
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['error' => 'ID da categoria não fornecido']);
    }
    
} catch (Exception $e) {
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => $e->getMessage()]);
}

die();
?>
