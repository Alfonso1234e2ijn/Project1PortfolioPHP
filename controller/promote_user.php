<?php
session_start(); // Inicia la sessió per poder utilitzar variables de sessió

// Comprova si la sessió està configurada i si el rol de l'usuari és 'admin'
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ../view/login_view.php'); // Redirigeix a la pàgina de login si no és admin
    exit(); // Acaba l'execució del script
}

// Recupera la llista d'usuaris de la sessió (o un array buit si no existeix)
$users = $_SESSION['users'] ?? [];

// Comprova si s'ha rebut una sol·licitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name_to_promote = trim($_POST['username']); // Obtén el nom de l'usuari a promoure

    $user_found = false; // Inicialitza la variable per saber si l'usuari ha estat trobat
    foreach ($users as &$user) { // Itera sobre cada usuari
        // Compara el nom de l'usuari amb el nom proporcionat (sense tenir en compte les majúscules/minúscules)
        if (strcasecmp($user['username'], $name_to_promote) === 0) {
            $user_found = true; // Marca que s'ha trobat l'usuari

            // Comprova si l'usuari no és ja 'admin'
            if ($user['rol'] !== 'admin') {
                $user['rol'] = 'admin'; // Promou l'usuari a admin
                $_SESSION['message'] = "Usuari promogut a admin: $name_to_promote"; // Missatge d'èxit
            } else {
                $_SESSION['message'] = "L'usuari $name_to_promote ja és admin."; // Missatge si ja és admin
            }
            break; // Surt del bucle una vegada trobat l'usuari
        }
    }

    // Si no s'ha trobat l'usuari, estableix un missatge d'error
    if (!$user_found) {
        $_SESSION['message'] = "Usuari no trobat: $name_to_promote";
    }

    // Actualitza la llista d'usuaris a la sessió
    $_SESSION['users'] = $users;

    // Redirigeix a la mateixa pàgina per mostrar el missatge
    header("Location: promote_user.php");
    exit(); // Acaba l'execució del script
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Promoure Usuari</title>
    <link rel="stylesheet" href="../style/promoteUsersStyle.css">
    <style>
        body {
            background-image: url('https://images.pexels.com/photos/2341290/pexels-photo-2341290.jpeg?cs=srgb&dl=pexels-hngstrm-2341290.jpg&fm=jpg');
            background-size: cover;
        }
    </style>
</head>
<body>
    <h1>Promoure Usuari</h1>
    
    <?php
    // Comprova si hi ha un missatge a mostrar i l'imprimeix
    if (isset($_SESSION['message'])) {
        echo "<p>" . htmlspecialchars($_SESSION['message']) . "</p>"; // Mostra el missatge de la sessió
        unset($_SESSION['message']); // Elimina el missatge de la sessió després de mostrar-lo
    }
    ?>

    <form method="POST"> <!-- Formulario per promoure un usuari -->
        <label for="username">Nom de l'usuari a promoure:</label>
        <input type="text" id="username" name="username" required> <!-- Input per introduir el nom de l'usuari -->
        <button type="submit">Promoure</button> <!-- Botó per enviar el formulari -->
    </form>

    <nav>
        <ul>
            <li><a href="../templates/navbar_normal.php">Tornar a l'inici</a></li> <!-- Enllaç per tornar a la pàgina d'inici -->
        </ul>
    </nav>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Festival de Música. Tots els drets reservats.</p> <!-- Peu de pàgina amb l'any actual -->
    </footer>
</body>
</html>
