$(document).ready(function() {
    
    var backendURL = '/projeto/Repositorio_SIR/SIR-Culinary/Controllers/AdicionarReceitas.php';

  
    $('#btnAdicionarReceita').click(function() {
      
        var formData = new FormData($('#formAdicionarReceitaData')[0]);

        formData.append('ingredientes', JSON.stringify(ingredientesArray));

       
        if (!validarCampos()) {
           
            alert('Por favor, preencha todos os campos obrigatórios.');
            return;
        }

    
        $.ajax({
            type: 'POST',
            url: backendURL,
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
        
                console.log(response);
            },
            error: function(error) {
            
                console.error(error);
            }
        });
    });


    function validarCampos() {
        var titulo = $('#titulo').val().trim();
        var modoPreparo = $('#modoPreparo').val().trim();
        var categorias = $('#categorias').val().trim();

        if (!titulo || !modoPreparo || !categorias) {
            return false;
        }
    
        return true;
    }
});