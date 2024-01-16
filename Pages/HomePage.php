<!doctype html>
<html lang="en">

<head>
  <title>Chefs touch</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
  rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
  crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&display=swap">
  <link href="./assets/css/Style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="./jsc/main/globals.js"></script>

 
</head>

<body>
    
  <header>
    <nav id="navbar" class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid d-flex justify-content-between align-items-center">


            <a class="navbar-brand testJs" data-id='' href="#header">
                <img src="./assets/images/Logo/L2.jpg"  alt="Logotipo" class="ms-2">
            </a>


            <form id="searchForm" class="d-flex flex-grow-1 justify-content-center">
                <input id="searchInput" class="form-control me-2 flex-grow-1" type="search" placeholder="Pesquisa" aria-label="Search" style="max-width: 500px;">
                <button id="customButton" type="submit" class="custom-buttonH">
                <i class="fa-solid fa-magnifying-glass fa-1x"></i>
                </button>
            </form>

            <form class="d-flex justify-content-end d-none d-md-block">
                <div style="text-align: center; margin-right: 30px" type="button" class="custom-buttonH">
                        <i class="fa-solid fa-heart fa-1x"></i>
                    </div>
                <div style="text-align: center; margin-right: 30px" type="button" class="custom-buttonH">
                    <i class="fa-solid fa-book-open  fa-1x"></i>
                </div>
                <div style="text-align: center; margin-right: 30px" type="button" class="custom-buttonH" data-bs-toggle="modal" data-bs-target="#CriarReceita">
                    <i class="fa-solid fa-file-circle-plus fa-1x"></i>
                </div>
                <a href="perfilpage.php">
                    <img class="rounded-circle me-3 max-width-user_image_nav" src="<?php echo $utilizador->getImagem();?>" alt="">
                </a>       
            </form>
        </div>
    </nav>
    
         
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 d-block d-md-none ">
                <footer class="navbar fixed-bottom navbar-light bg-light d-flex justify-content-around">
                    <div style="text-align: center" type="button" class="custom-buttonH">
                        <i class="fa-solid fa-heart fa-2x"></i>
                        <span class="button__text">Fav</span>
                    </div>
                    <div style="text-align: center;" type="button" class="custom-buttonH" data-bs-toggle="modal" data-bs-target="#CriarReceita">
                        <i class="fa-solid fa-file-circle-plus  fa-2x"></i>
                        <span class="button__text">Criar receita</span>
                    </div>
                    <div style="text-align: center;" type="button" class="custom-buttonH">
                        <i class="fa-solid fa-book-open  fa-2x"></i>
                        <span class="button__text">receitas</span>
                    </div>
                        <img class="rounded-circle me-3 max-width-user_image_nav" src="<?php echo $utilizador->getImagem();?>" alt="">
                </footer>
            </div>    
        </div>
    </div>


</header>



<main>  


    <section class="container">
        <div class="categorias-bar">
            <?php foreach ($listacategorias as $categoria) : ?>
            <button class="btn card-shine-effect testJs" data-id="<?php echo $categoria->getNome(); ?>"><?php echo $categoria->getNome();?></button>
            <?php endforeach; ?>
        </div>
    </section>

  

    <section class="container">
        <div class="row" data-id="" id="masonry-container">
        </div>
    </section>

    <script>
    $(document).ready(function() {
        // Adiciona um ouvinte de eventos para clicar nas cards
        $('.testJs').click(function() {
            // Recupera o valor do atributo data-user-id da card clicada
            var userId = $(this).data('user-id');

            // Abre o modal de teste
            abrirModal();
        });

        // Função para abrir o modal de teste
        function abrirModal() {
            // Lógica para abrir o modal de teste
            $('#exemploModal').modal('show');
        }
    });
</script>

<div class="modal fade" id="exemploModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal de Teste</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <!-- Conteúdo do modal aqui -->
                <p>Conteúdo do modal de teste.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


<?php

    #var_dump($Receitacompleta);
    
        #$status = session_status();

        #if ($status == PHP_SESSION_ACTIVE) {
        #     echo "A sessão está ativa.";
        #} elseif ($status == PHP_SESSION_NONE) {
        #    echo "A sessão está habilitada, mas não existe.";
        #} elseif ($status == PHP_SESSION_DISABLED) {
        #    echo "As sessões estão desabilitadas.";
        #}

    #session_destroy();
 ?>


<div class="modal fade" id="CriarReceita" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Criar Receita</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formAdicionarReceitaData" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">*Título:</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>
                    <div id="ingredientesContainer" class="mb-3">
                        <label class="form-label">Ingredientes:</label>
                        <div class="ingredientes">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="idnomeIngrediente" name="nomeIngredientes[]" placeholder="Nome do Ingrediente" required>
                                <input type="text" class="form-control" name="quantidade[]" placeholder="Quantidade" required>
                                <input type="text" class="form-control" name="valor[]" placeholder="Valor" required>
                                <input type="text" class="form-control" name="Origem[]" placeholder="Origem" required>
                                <button class="btn btn-outline-secondary" type="button" name="adicionarIngrediente">Adicionar</button>
                            </div>
                        </div>
                        <ul id="listaIngredientes" class="list-group mt-3"></ul>
                    </div>
                    <div class="mb-3">
                        <label for="modoPreparo" class="form-label">*Modo de Preparo:</label>
                        <textarea class="form-control" id="modoPreparo" name="modoPreparo" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="notas" class="form-label">Notas/Extras:</label>
                        <textarea class="form-control" id="notas" name="notas" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="anexo" class="form-label">Anexo:</label>
                        <input type="file" class="form-control" id="anexo" name="anexo">
                    </div>
                    <div class="mb-3">
                        <label for="categorias" class="form-label">*Categoria:</label>
                        <textarea class="form-control" id="categorias" name="categorias" rows="1" required></textarea>
                    </div>
                    <a style="display: inline-block;" class="small text-muted">* Dados Obrigatórios</a>
                    <div class="modal-footer">
                    <button class="button typeanimation" type="button" id="btnAdicionarReceita">
                              <div class="button__line"></div>
                              <div class="button__line"></div>
                              <span class="button__text">Criar Receita</span>
                              <div class="button__drow1"></div>
                              <div class="button__drow2"></div> 
                    </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="./assets/js/masonry_script.js"></script>
<script src="./assets/js/atualizarReceitas.js"></script>
<script src="./assets/js/pesquisarReceitas.js"></script>
<script src="./jsc/main/IngredientesReceitas.js"></script>
<script src="./jsc/main/CriarReceitas.js"></script>

</body>

</html>