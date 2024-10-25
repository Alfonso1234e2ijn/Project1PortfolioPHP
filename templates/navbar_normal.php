<?php
session_start();

function verificarAcces()
{
    if (!isset($_SESSION['loggedInUser']) || !$_SESSION['loggedInUser']) {
        header('Location: ../view/login_view.php');
        exit();
    }
}

verificarAcces();

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <title>Login</title>
    <style>
        body {
            background-image: url('https://www.vcvauto.com/wp-content/uploads/2024/08/EventosMadrid2024.webp');
            background-size: cover;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/controller/profile_controller.php">
                <i class="fas fa-user"></i> Perfil
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            EVENTS
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/events/event_musica.php">Musica</a></li>
                            <li><a class="dropdown-item" href="/events/event_cine.php">Cine</a></li>
                            <li><a class="dropdown-item" href="/events/event_teatre.php">Teatre</a></li>
                            <li><a class="dropdown-item" href="/events/index_afegir.php">Afegir event</a></li>
                            <?php
                            $user = $_SESSION['loggedInUser'];

                            if ($user['rol'] == "admin") {
                                ?>
                                <li><a class="dropdown-item" href="/events/index_eliminar.php">Eliminar event</a></li>
                                <li><a class="dropdown-item" href="/events/index_modificar.php">Modificar event</a></li>
                                <?php
                            } else if ($user['rol'] == "user") {
                                ?>
                                    <li>
                                        <p>Per més opcions has de ser admin</p>
                                    </li>
                                <?php
                            }
                            ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                        </ul>
                    </li>
                    <?php if ($user['rol'] == 'admin'): // Nomes mostrar si el rol es admin ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                GESTIO D'USUARIS
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/controller/showAllUsers.php">Mostrar tots els
                                        usuaris</a></li>
                                <li><a class="dropdown-item" href="/controller/promote_user.php">Promoure usuaris</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item" style="margin-right: 0;">
                        <a class="nav-link active" aria-current="page" href="../controller/logout_controller.php">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</body>

</html>