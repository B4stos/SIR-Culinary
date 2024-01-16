$(document).ready(function() {
    // Defina a URL do backend em um arquivo de configuração
    var backendURL = '/projeto/Repositorio_SIR/SIR-Culinary/Controllers/AdicionarReceitas.php';
    console.log(ingredientesArray);

    // Adicione um ouvinte de eventos para o clique no botão
    $('#btnAdicionarReceita').click(function() {
        // Coletar dados do formulário
        var formData = new FormData($('#formAdicionarReceitaData')[0]);

        // Adicionar a lista de ingredientes aos dados do formulário
        formData.append('ingredientes', JSON.stringify(ingredientesArray));

        // Enviar solicitação AJAX
        $.ajax({
            type: 'POST',
            url: backendURL,
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Lógica de manipulação de sucesso
                console.log(response);
            },
            error: function(error) {
                // Lógica de manipulação de erro
                console.error(error);
            }
        });
    });
});
