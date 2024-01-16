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

// Verifica se a requisição é do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $titulo = $_POST['titulo'];
    $modoPreparo = $_POST['modoPreparo'];
    $notas = $_POST['notas'];
    $dadosCategoria = $_POST['categorias'];

    // Lista de ingredientes (vem como uma string JSON)
    $Dadosingredientes = isset($_POST['ingredientes']) ? json_decode($_POST['ingredientes'], true) : [];

    // Processa o upload do anexo, se fornecido
    $anexoDir = ".\.\uploads\C"; 
    $anexoNome = isset($_FILES['anexo']['name']) ? $_FILES['anexo']['name'] : '';

    if ($anexoNome != "") {
        $anexoDestino = $anexoDir . $anexoNome;
        move_uploaded_file($_FILES['anexo']['tmp_name'], $anexoDestino);
    } else {
        $anexoDestino = null;
    }

    $ingredientes = []; 

    foreach ($Dadosingredientes as $dadosIngrediente) {
    // Criar uma nova instância de Ingrediente dentro do loop
    $ingrediente = new Ingrediente(
        null,
        $dadosIngrediente['nome'],
        $dadosIngrediente['quantidade'],
        $dadosIngrediente['Origem'],
        $dadosIngrediente['valor']
    );

        // Adicionar o objeto Ingrediente ao array $ingredientes
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
        null, // A data pode ser definida no backend ou no banco de dados
        null, // Favorito - você pode ajustar conforme necessário
        $ingredientes,
        $anexo,
        $notas, 
        null, // Data da descrição - você pode ajustar conforme necessário
        null, // Comentários - você pode ajustar conforme necessário
        $categoria, // Categorias - você pode ajustar conforme necessário
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