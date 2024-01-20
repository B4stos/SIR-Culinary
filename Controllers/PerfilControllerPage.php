<?php

namespace Controllers;

require_once(__DIR__."/../Classes/Database.php");
require_once(__DIR__."/../Classes/Receita.php");
require_once(__DIR__."/../Classes/Utilizador.php");

use Classes\Database;
use Classes\Receita;
use Classes\Utilizador;

class PerfilPageController
{
    public $database;

    public function __construct()
    {
        $this->database = new Database();
        $this->database->connect();
    }

    public function index()
{
    
    $users = $this->database->getAllUsers();
    $errorMsg = ""; 

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
        $user_id = 1; 

        $editFirstName = $_POST['editFirstName'];
        $editLastName = $_POST['editLastName'];
        $editEmail = $_POST['editEmail'];
        $editTelefone = $_POST['editTelefone'];

        $imageDir = __DIR__ . "/../imgsupload/"; 
        $imageName = $_FILES['editImagem']['name'];
        $imageTmp = $_FILES['editImagem']['tmp_name'];
        $imagePath = $imageDir . basename($imageName);

        if ($_FILES['editImagem']['error'] !== UPLOAD_ERR_OK) {
            $errorMsg = "Image upload failed with error code: " . $_FILES['editImagem']['error'];
        } else {
            if (move_uploaded_file($imageTmp, $imagePath)) {
                $this->database->updateUserImage($user_id, $imagePath);
            } else {
                $errorMsg = "Image upload failed.";
            }
        }
        if (!$this->database->isEmailTaken($editEmail, $user_id) && !$this->database->isTelefoneTaken($editTelefone, $user_id)) {
            $this->database->updateUserInfo($user_id, $editFirstName, $editLastName, $editEmail, $editTelefone);
            $users = $this->database->getAllUsers();
            echo '<script>$("#editarPerfilModal").modal("hide");</script>';
            header("Location: PerfilPage.php");
            exit();
        } else {
            $errorMsg = "Email or telefone is already taken.";
        }
    }

    include __DIR__."/../Pages/PerfilPage.php";
}
}

?>