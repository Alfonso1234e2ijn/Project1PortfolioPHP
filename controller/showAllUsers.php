<?php
// users.php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$users = $_SESSION['users'] ?? []; //Evitem errors en cas que hi hagi algun null
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Llistat d'usuaris</title>
    <link rel="stylesheet" href="../style/mostrarUsersStyle.css">
    <style>
        body {
            background-image: url('https://images.pexels.com/photos/2341290/pexels-photo-2341290.jpeg?cs=srgb&dl=pexels-hngstrm-2341290.jpg&fm=jpg');
            background-size: cover;
        }
    </style>
</head>
<body>
    <h1>Llistat d'usuaris</h1>
    <ul>
        <?php foreach ($users as $user): ?>
            <li><?php echo htmlspecialchars($user['name']); ?> (<?php echo htmlspecialchars($user['mail']); ?>)</li>
        <?php endforeach; ?>
    </ul>
    <nav>
        <ul>
            <li><a href="../templates/navbar_normal.php">Tornar a l'inici</a></li>
        </ul>
    </nav>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Festival de Música. Tots els drets reservats.</p>
    </footer>
</body>
</html>
