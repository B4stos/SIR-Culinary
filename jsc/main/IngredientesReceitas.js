src="./jsc/main/globals.js">
$(document).ready(function() {
   
    ingredientesArray = [];

   
    var nomeIngredienteInput = $('#idnomeIngrediente');
    var quantidadeInput = $('input[name="quantidade[]"]');
    var valorInput = $('input[name="valor[]"]');
    var origemInput = $('input[name="Origem[]"]');
    var listaIngredientes = $('#listaIngredientes');

    function adicionarIngrediente() {
        var nome = nomeIngredienteInput.val();
        var quantidade = quantidadeInput.val();
        var valor = valorInput.val();
        var origem = origemInput.val();

        if (nome) {

            ingredientesArray.push({ nome: nome, quantidade: quantidade, valor: valor, origem: origem });

            nomeIngredienteInput.val('');
            quantidadeInput.val('');
            valorInput.val('');
            origemInput.val('');

            atualizarListaIngredientes();
        } else {
            alert('Preencha o campo do nome do ingrediente.');
        }
    }

    function removerIngrediente(index) {
     
        ingredientesArray.splice(index, 1);
        atualizarListaIngredientes();
    }

   
    function atualizarListaIngredientes() {
       
        listaIngredientes.empty();

        ingredientesArray.forEach(function(ingrediente, index) {
            var listItem = $('<li class="list-group-item"></li>').text(`Nome: ${ingrediente.nome}, Quantidade: ${ingrediente.quantidade}, Valor: ${ingrediente.valor}, Origem: ${ingrediente.origem}`);
            var removerButton = $('<button class="btn btn-danger btn-sm ms-2">Remover</button>').click(function() {
                removerIngrediente(index);
            });
            listItem.append(removerButton);

            listaIngredientes.append(listItem);
        });
    }

    $('button[name="adicionarIngrediente"]').click(function() {
        adicionarIngrediente();
    });
});