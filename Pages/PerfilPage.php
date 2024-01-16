<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="./assets/css/Style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&display=swap">

    <style>
        .profile-container {
            text-align: center;
            margin-top: 50px;
        }

        .profile-image {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
        }

        .profile-details {
            margin-top: 20px;
        }

        .perfil-navbar a {
            color: #000000 !important; /* Set to the desired font color */
            font-family: 'Oswald', sans-serif;
            font-size: 17px; /* Set to the desired font size */
            font-weight: 600;
        }

        .perfil-navbar .nav-link {
            text-decoration: none;
            color: inherit;
            display: inline-block;
            padding: 0.5rem 1rem;
        }

        .perfil-navbar .nav-link:hover {
            text-decoration: underline;
        }

        .perfil-navbar .nav-link.active {
            background-color: transparent !important;
        }
    </style>
    <title>User Profile</title>
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top perfil-navbar">
    <a class="navbar-brand text-light" href="Homepage.php">
        <!-- Back button arrow -->
        &#8592; Voltar
    </a>
    <ul class="nav nav-pills mx-auto nav-underline">
        <li class="nav-item">
            <a class="nav-link active" id="perfil-tab" data-toggle="pill" href="#perfil">Perfil</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="receitas-tab" data-toggle="pill" href="#receitas">Receitas Favoritas</a>
        </li>
    </ul>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="perfil">
                    <?php if (!empty($users)): ?>
                        <div class="profile-container">
                            <?php $user = $users[0]; // Access the first user ?>
                            <img src="imgsupload/<?= basename($user->getImagem()); ?>" alt="Profile Image" class="profile-image">
                            <div class="profile-details">
                                <div class="profile-name" style="font-family: 'Oswald', sans-serif;">
                                    <h4><?php echo $user->getFirstName() . ' ' . $user->getLastName(); ?></h4>
                                </div>
                                <p>
                                    <span style="font-family: 'Oswald', sans-serif; color: #000000;"><strong>Email:</strong></span>
                                    <?php echo $user->getEmail(); ?>
                                </p>
                                <p>
                                    <span style="font-family: 'Oswald', sans-serif; color: #000000;"><strong>Contacto:</strong></span>
                                    <?php echo $user->getTelefone(); ?>
                                </p>
                                <!-- Add more user details as needed -->

                                <!-- "Editar Perfil" Button -->
                                <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#editarPerfilModal">
                                    Editar Perfil
                                </button>
                            </div>
                        </div>

                        <!-- Bootstrap Modal -->
                        <div class="modal fade" id="editarPerfilModal" tabindex="-1" role="dialog" aria-labelledby="editarPerfilModalLabel" aria-hidden="true" style="font-family: 'Oswald', sans-serif; color: #000000;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editarPerfilModalLabel">Editar Perfil</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php if (isset($errorMsg)): ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?php echo $errorMsg; ?>
                                            </div>
                                        <?php endif; ?>
                                        <!-- Form for editing user profile -->
                                        <form action="" method="POST" enctype="multipart/form-data"> <!-- Replace "updateProfile.php" with the actual PHP script to handle form submission -->
                                            <!-- File upload input for the image -->
                                            <div class="form-group">
                                                <label for="editImagem">Profile Image</label>
                                                <input type="file" class="form-control-file" id="editImagem" name="editImagem" accept=".png, .jpg, .jpeg">
                                            </div>
                                            <div class="form-group">
                                                <label for="editFirstName">First Name</label>
                                                <input type="text" class="form-control" id="editFirstName" name="editFirstName" value="<?php echo $user->getFirstName(); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="editLastName">Last Name</label>
                                                <input type="text" class="form-control" id="editLastName" name="editLastName" value="<?php echo $user->getLastName(); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="editEmail">Email</label>
                                                <input type="email" class="form-control" id="editEmail" name="editEmail" value="<?php echo $user->getEmail(); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="editTelefone">Phone</label>
                                                <input type="tel" class="form-control" id="editTelefone" name="editTelefone" value="<?php echo $user->getTelefone(); ?>">
                                            </div>
                                            <!-- Add more form fields as needed -->

                                            <button type="submit" class="btn btn-outline-success" name="saveChanges">
                                                Save Changes
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <p>No user found.</p>
                    <?php endif; ?>
                </div>

                <div class="tab-pane fade" id="receitas">
                    <h2>As suas Receitas Favoritas!</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>