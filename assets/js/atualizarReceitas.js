function atualizarReceitas() {
    console.log('Atualizando receitas...');
    let data={}
    let nomeCategoria=$("#masonry-container").attr("data-id");
    let termoPesquisa = $("#masonry-container").attr("data-pesquisa");
    console.log($("#masonry-container"));
    let url='';
    if (termoPesquisa && termoPesquisa.length > 0) {
        url = '/projeto/Repositorio_SIR/SIR-Culinary/Controllers/ReceitasTitulo.php';
        data = { termo_pesquisa: termoPesquisa };  
    } else if (nomeCategoria.length > 0) {
        url = '/projeto/Repositorio_SIR/SIR-Culinary/Controllers/ReceitasCategorias.php';
        data = { id_categoria: nomeCategoria };
    } else {
        url = '/projeto/Repositorio_SIR/SIR-Culinary/Controllers/AtualizarReceitas.php';
    }
    console.log(url)
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        data:data,
        success: function(data) {
            console.log(data);
            if (data && data.length > 0) {
               let html="";
                $.each(data, function(index, receita) {
                        html += '<div class="col-md-4 masonry-item testJs" data-user-id="' + receita.user_id + '">' +
                        '<div class="d-flex receita-card justify-content-center align-items-center ">' +
                        '<img src="' + receita.imagem_anexo + '" class="receita-card-img-top" alt="Imagem da Receita">' +
                        '<div class="receita-card-body">' +
                        '<h5 class="receita-card-title">' + receita.titulo_receita + '</h5>' +
                        '<p class="receita-card-text">Categorias:</p>' +
                        '<p class="receita-card-text" style="margin-bottom: 60px;">' + receita.nome_categoria + '</p>' +
                        '<img class="rounded-circle max-width-user_image" src="' + receita.imagem_usuario + '" alt="user imagem">' +
                        '<p class="receita-card-text">' + receita.first_name + '</p>' +
                        '<p class="receita-card-text">' + receita.data + '</p>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                });
                $('#masonry-container').html(html);
            } else {
                console.log('Nenhuma receita encontrada.');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Erro ao buscar as receitas:', textStatus, errorThrown);
            reject(errorThrown); 
        }
    });
}

setInterval(function() {
    atualizarReceitas()
}, 10000);

atualizarReceitas()
