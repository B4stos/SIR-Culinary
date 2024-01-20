<?php

require_once (__DIR__."/../Classes/Database.php");
use Classes\Database;

require_once (__DIR__."/../Classes/ReceitaCompleta.php");
use Classes\ReceitaCompleta;

require_once (__DIR__."/../Classes/Utilizador.php");
use Classes\Utilizador;

require_once (__DIR__."/../Classes/Ingrediente.php");
use Classes\Ingrediente;

require_once (__DIR__."/../Classes/Anexo.php");
use Classes\Anexo;

require_once (__DIR__."/../Classes/Categoria.php");
use Classes\Categoria;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $titulo = $_POST['titulo'];
    $modoPreparo = $_POST['modoPreparo'];
    $notas = $_POST['notas'];
    $dadosCategoria = $_POST['categorias'];

    
    $Dadosingredientes = isset($_POST['ingredientes']) ? json_decode($_POST['ingredientes'], true) : [];


    $anexoDir = ".\.\uploads\D";
    $anexoNome = isset($_FILES['anexo']['name']) ? $_FILES['anexo']['name'] : '';

    if ($anexoNome != "") {
        $anexoDestino = $anexoDir . $anexoNome;
        move_uploaded_file($_FILES['anexo']['tmp_name'], $anexoDestino);
    } else {
        $anexoDestino = null;
    }

    $ingredientes = []; 

    foreach ($Dadosingredientes as $dadosIngrediente) {

    $ingrediente = new Ingrediente(
        null,
        $dadosIngrediente['nome'],
        $dadosIngrediente['quantidade'],
        $dadosIngrediente['Origem'],
        $dadosIngrediente['valor']
    );
        $ingredientes[] = $ingrediente;
    }
    $anexo = new Anexo(
        null,
        null,
        $anexoDestino,
        null,
        null
    );

    $categoria = new Categoria(
        null,
        $dadosCategoria
    );

    $receita = new ReceitaCompleta(
        null, 
        $titulo,
        $modoPreparo,
        null, 
        null,
        $ingredientes,
        $anexo,
        $notas, 
        null, 
        null, 
        $categoria, 
        null
    );

    var_dump($receita);

    $database = new Database();
    $database->connect();

    $database->adicionarReceita($receita);

    $response = array("status" => "success", "message" => "Receita adicionada com sucesso!");
    echo json_encode($response);
} else {
    $response = array("status" => "error", "message" => "Método de requisição inválido.");
    echo json_encode($response);
}
?>