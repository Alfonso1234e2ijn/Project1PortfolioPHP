<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['loggedInUser'])) {
    header('Location: ../views/login_view.php');
    exit();
}
$user = $_SESSION['loggedInUser'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newName = htmlspecialchars(trim($_POST['name']));
    $newUsername = htmlspecialchars(trim($_POST['username']));
    $newMail = htmlspecialchars(trim($_POST['mail']));

    $users = $_SESSION['users'];
    foreach ($users as &$userData) {
        if ($userData['id'] === $user['id']) {
            $userData['name'] = $newName;
            $userData['username'] = $newUsername;
            $userData['mail'] = $newMail;

            $_SESSION['loggedInUser']['name'] = $newName;
            $_SESSION['loggedInUser']['username'] = $newUsername;
            $_SESSION['loggedInUser']['mail'] = $newMail;
            break;
        }
    }
    $_SESSION['users'] = $users;

    header('Location: ' . $_SERVER['PHP_SELF'] . '?success=1');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil d'Usuari</title>
    <link rel="stylesheet" href="/events/event_styles/style.css">
</head>
<body>
    <header>
        <h1>Benvingut, <?php echo htmlspecialchars($user['name']); ?></h1>
    </header>

    <main>
        <section id="user-info">
            <h2>Informació de l'Usuari</h2>
            <p><strong>ID:</strong> <?php echo htmlspecialchars($user['id']); ?></p>
            <p><strong>Nom:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
            <p><strong>Nom d'usuari:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['mail']); ?></p>
            <p><strong>Rol:</strong> <?php echo htmlspecialchars($user['rol']); ?></p>
        </section>

        <section id="actions">
            <h2>Accions</h2>
            <a href="../templates/navbar_normal.php">Tornar a inici</a>
        </section>

        <section id="modificar" style="margin-top: 20px;">
            <h3>Modificar Dades Usuari</h3>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div>
                    <label for="name">Nom:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                </div>
                <div>
                    <label for="username">Nom d'usuari:</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                </div>
                <div>
                    <label for="mail">Email:</label>
                    <input type="email" id="mail" name="mail" value="<?php echo htmlspecialchars($user['mail']); ?>" required>
                </div>
                <div>
                    <button type="submit">Guardar Canvis</button>
                </div>
            </form>
            <?php if (isset($_GET['success'])): ?>
                <p class="success-message" style="color: green;">Informació actualitzada correctament.</p>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Sistema de Gestió d'Usuaris. Tots els drets reservats.</p>
    </footer>
</body>
</html>
