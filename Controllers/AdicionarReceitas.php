<?php

require_once (__DIR__."/ReceitaCompleta.php");
use Classes\ReceitaCompleta;

require_once (__DIR__."/Ingredientes.php");
use Classes\Ingrediente;

require_once (__DIR__."/Anexo.php");
use Classes\Anexo;

require_once (__DIR__."/Categoria.php");
use Classes\Categoria;

$utilizador = $_SESSION['utilizador'];

// Verifica se a requisição é do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtém os dados do formulário
    $titulo = $_POST['titulo'];
    $modoPreparo = $_POST['modoPreparo'];
    $notas = $_POST['notas'];
    $dadosCategoria = $_POST['categorias'];

    // Lista de ingredientes (vem como uma string JSON)
    $Dadosingredientes = json_decode($_POST['ingredientes'], true);

    // Processa o upload do anexo, se fornecido
    $anexoDir = "diretorio_de_anexos/"; // Substitua pelo seu diretório desejado
    $anexoNome = $_FILES['anexo']['name'];

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
        null, // A data pode ser definida no backend ou no banco de dados
        null, // Favorito - você pode ajustar conforme necessário
        $ingrediente,
        $anexo,
        null, // Descrição - você pode ajustar conforme necessário
        null, // Data da descrição - você pode ajustar conforme necessário
        null, // Comentários - você pode ajustar conforme necessário
        $categoria, // Categorias - você pode ajustar conforme necessário
        $utilizador->getUserId() // User - você pode ajustar conforme necessário
    );

    

    // Exemplo de retorno para o frontend (você pode ajustar conforme necessário)
    $response = array("status" => "success", "message" => "Receita adicionada com sucesso!");
    echo json_encode($response);
} else {
    // Se a requisição não for do tipo POST, retorna um erro
    $response = array("status" => "error", "message" => "Método de requisição inválido.");
    echo json_encode($response);
}
?>
