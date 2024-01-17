src="./jsc/main/globals.js">
$(document).ready(function() {
    // Array para armazenar os ingredientes
    ingredientesArray = [];

    // Cache dos seletores para melhor desempenho
    var nomeIngredienteInput = $('#idnomeIngrediente');
    var quantidadeInput = $('input[name="quantidade[]"]');
    var valorInput = $('input[name="valor[]"]');
    var origemInput = $('input[name="Origem[]"]');
    var listaIngredientes = $('#listaIngredientes');

    // Função para adicionar um novo ingrediente à lista
    function adicionarIngrediente() {
        var nome = nomeIngredienteInput.val();
        var quantidade = quantidadeInput.val();
        var valor = valorInput.val();
        var origem = origemInput.val();

        // Validar se o campo de nome do ingrediente está preenchido
        if (nome) {
            // Adicionar ingrediente ao array
            ingredientesArray.push({ nome: nome, quantidade: quantidade, valor: valor, origem: origem });

            // Limpar os campos do formulário
            nomeIngredienteInput.val('');
            quantidadeInput.val('');
            valorInput.val('');
            origemInput.val('');

            // Atualizar a lista de ingredientes na interface
            atualizarListaIngredientes();
        } else {
            alert('Preencha o campo do nome do ingrediente.');
        }
    }

    // Função para remover um ingrediente da lista
    function removerIngrediente(index) {
        // Remover o ingrediente do array
        ingredientesArray.splice(index, 1);

        // Atualizar a lista de ingredientes na interface
        atualizarListaIngredientes();
    }

    // Função para atualizar a lista de ingredientes na interface
    function atualizarListaIngredientes() {
        // Limpar a lista existente
        listaIngredientes.empty();

        // Adicionar cada ingrediente à lista
        ingredientesArray.forEach(function(ingrediente, index) {
            var listItem = $('<li class="list-group-item"></li>').text(`Nome: ${ingrediente.nome}, Quantidade: ${ingrediente.quantidade}, Valor: ${ingrediente.valor}, Origem: ${ingrediente.origem}`);
            var removerButton = $('<button class="btn btn-danger btn-sm ms-2">Remover</button>').click(function() {
                removerIngrediente(index);
            });
            listItem.append(removerButton);

            listaIngredientes.append(listItem);
        });
    }

    // Adicionar um ouvinte de eventos para o botão "Adicionar"
    $('button[name="adicionarIngrediente"]').click(function() {
        adicionarIngrediente();
    });
});