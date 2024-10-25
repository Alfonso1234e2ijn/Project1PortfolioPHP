<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Iniciar Sessió</title>
    <style>
        body {
            background-image: url('https://images.pexels.com/photos/2341290/pexels-photo-2341290.jpeg?cs=srgb&dl=pexels-hngstrm-2341290.jpg&fm=jpg');
            background-size: cover;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Iniciar Sessió</h2>
        <form action="../controller/login_controller.php" method="POST">
            <p>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </p>
            <p>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </p>
            <p>
                <input type="submit" value="Enviar">
            </p>
            <p>
                No estás registrat? <a href="register_view.php">Registra't</a>
            </p>
        </form>
    </div>
</body>
</html>