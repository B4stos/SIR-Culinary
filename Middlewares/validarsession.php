<?php

require_once (__DIR__."/../Classes/Utilizador.php");

session_start();

if (isset($_SESSION['utilizador'])) {

    $utilizador = $_SESSION['utilizador'];
    $utilizador->setDefaultImagemUsuario();
    return $utilizador->getUserId();
    
} else {

    header("Location: index.html");
    exit();
}
?>
