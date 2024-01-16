<?php
require_once (__DIR__."/../Classes/Database.php");
use Classes\Database;

$titulo = $_GET['termo_pesquisa'] ?? null;

$database = new Database();
$database->connect();

$receitas = $database->getReceitaCardtitulo($titulo);

error_log(print_r($receitas, true));
error_log(gettype($receitas));

if (empty($receitas)) {
    header('HTTP/1.1 404 Not Found');
    echo json_encode(['error' => 'Nenhuma receita encontrada.']);
} else {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($receitas, JSON_UNESCAPED_UNICODE);
}
 
die();
?>
