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
    $joms = "A";
    $users = $this->database->getAllUsers();
    $errorMsg = ""; // Initialize error message variable

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Form is submitted, handle the data
        $user_id = 1; // Replace with the actual user_id

        $editFirstName = $_POST['editFirstName'];
        $editLastName = $_POST['editLastName'];
        $editEmail = $_POST['editEmail'];
        $editTelefone = $_POST['editTelefone'];

        // Image upload handling
        $imageDir = __DIR__ . "/../imgsupload/"; // Updated to the imgsupload folder
        $imageName = $_FILES['editImagem']['name'];
        $imageTmp = $_FILES['editImagem']['tmp_name'];
        $imagePath = $imageDir . basename($imageName);

        // Check if the file was successfully uploaded
        if ($_FILES['editImagem']['error'] !== UPLOAD_ERR_OK) {
            $errorMsg = "Image upload failed with error code: " . $_FILES['editImagem']['error'];
        } else {
            // Attempt to move the uploaded file to the destination
            if (move_uploaded_file($imageTmp, $imagePath)) {
                // Image uploaded successfully, update the user's profile image
                $this->database->updateUserImage($user_id, $imagePath);
            } else {
                // Handle the case where image upload fails
                $errorMsg = "Image upload failed.";
            }
        }

        // Separate logic for checking if email or telefone is already taken
        if (!$this->database->isEmailTaken($editEmail, $user_id) && !$this->database->isTelefoneTaken($editTelefone, $user_id)) {
            // Update the user information in the database
            $this->database->updateUserInfo($user_id, $editFirstName, $editLastName, $editEmail, $editTelefone);

            // Refresh user data after update
            $users = $this->database->getAllUsers();

            // Close modal after save
            echo '<script>$("#editarPerfilModal").modal("hide");</script>';

            // Redirect after successful form submission
            header("Location: PerfilPage.php");
            exit();
        } else {
            // Handle the case where email or telefone is already taken
            // You may display an error message or perform other actions
            $errorMsg = "Email or telefone is already taken.";
        }
    }

    include __DIR__."/../Pages/PerfilPage.php";
}
}

?>