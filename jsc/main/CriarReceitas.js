$(document).ready(function() {
    
    url = '/projeto/Repositorio_SIR/SIR-Culinary/Controllers/AdicionarReceitas.php';

    $('#btnAdicionarReceita').click(function() {
        // Coletar dados do formulário
        var formData = new FormData($('#formAdicionarReceitaData')[0]);

        // Adicionar a lista de ingredientes aos dados do formulário
        formData.append('ingredientes', JSON.stringify(ingredientesArray));

        // Enviar solicitação AJAX
        $.ajax({
            type: 'POST',
            url: url, // Substitua isso pela URL do seu backend
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