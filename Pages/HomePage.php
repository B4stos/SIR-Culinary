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
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
 
</head>

<body>
    
  <header>
    <nav id="navbar" class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid d-flex justify-content-between align-items-center">

            <button class="btn btn-secondary d-none d-md-block" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticCanvasLeft" aria-controls="staticCanvasLeft">
              <span class="navbar-toggler-icon"></span>
            </button>


            <a class="navbar-brand" href="#header">
                <img src="./assets/images/Logo/L2.jpg" alt="Logotipo" class="ms-2">
            </a>


            <form class="d-flex flex-grow-1 justify-content-center">
                <input class="form-control me-2 flex-grow-1" type="search" placeholder="Pesquisa" aria-label="Search" style="max-width: 500px;">
                <div style="text-align: center;" type="button" class="custom-buttonH">
                    <i class="fa-solid fa-magnifying-glass fa-1x"></i>
                </div>
            </form>

            <form class="d-flex justify-content-end d-none d-md-block">
                <div style="text-align: center; margin-right: 30px" type="button" class="custom-buttonH">
                    <i class="fa-solid fa-file-circle-plus fa-1x"></i>
                </div>
                <img class="rounded-circle me-3" src="https://dummyimage.com/40x40/ced4da/6c757d" alt="">       
            </form>
        </div>
    </nav>

    <div class="offcanvas offcanvas-start" tabindex="-1" data-bs-scroll="true" id="staticCanvasLeft" aria-labelledby="staticCanvasLeftLabel" data-bs-backdrop="false" style="margin-top: 78px; width: 200px;">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="staticCanvasLabelLeft">Canvas Estático left</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
    <div class="offcanvas-body">
        <p>Aqui está o conteúdo do canvas estático...</p>
        </div>
    </div> 

    
         
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 d-block d-md-none ">
                <footer class="navbar fixed-bottom navbar-light bg-light d-flex justify-content-around">
                    <div style="text-align: center" type="button" class="custom-buttonH">
                        <i class="fa-solid fa-house  fa-2x"></i>
                        <span class="button__text">Home</span>
                    </div>
                    <div style="text-align: center;" type="button" class="custom-buttonH">
                        <i class="fa-solid fa-file-circle-plus  fa-2x"></i>
                        <span class="button__text">Criar receita</span>
                    </div>
                    <div style="text-align: center;" type="button" class="custom-buttonH">
                        <i class="fa-solid fa-book-open  fa-2x"></i>
                        <span class="button__text">receitas</span>
                    </div>
                        <img class="rounded-circle me-4" src="https://dummyimage.com/50x50/ced4da/6c757d" alt="">
                </footer>
            </div>    
        </div>
    </div>


</header>



<main>  

<?php
        echo $joms;
        foreach ($receitas as $receita) {
            echo $receita->getTitulo(); 
            echo $receita->getModoPreparo();
        }
 ?>
</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
crossorigin="anonymous">
</script>
  
</body>

</html>