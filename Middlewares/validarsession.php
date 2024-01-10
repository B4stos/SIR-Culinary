<?php
session_start();

if (isset($_SESSION['utilizador'])) {

    $utilizador = $_SESSION['utilizador'];
} else {

    header("Location: index.html");
    exit();
}
?>
