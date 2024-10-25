<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style/style.css">
    <title>Iniciar Sesión</title>
    <style>
        body {
            background-image: url('https://images.pexels.com/photos/2341290/pexels-photo-2341290.jpeg?cs=srgb&dl=pexels-hngstrm-2341290.jpg&fm=jpg');
            background-size: cover;
        }
    </style>
</head>

<body>
    <form action="../controller/register_controller.php" method="POST" class="form-container">
        <p>
            <label for="name">Name</label>
            <input type="text" name="name" required>
        </p>
        <p>
            <label for="username">Username</label>
            <input type="text" name="username" required>
        </p>
        <p>
            <label for="password">Password</label>
            <input type="password" name="password" required>
        </p>
        <p>
            <label for="mail">Mail</label>
            <input type="text" name="mail" required>
        </p>
        <p>
            <input type="submit" value="Enviar">
        </p>
        <p>
            <a href="login_view.php">Tornar al login</a>
        </p>

    </form>
</body>

</html>