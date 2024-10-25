<?php
// login_controller.php
session_start();
include_once '../controller/user_controller.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        echo "Si us plau, introdueix tant l'usuari com la contrasenya.";
        exit;
    }

    $user = login($username, $password);
    if ($user) {
        $_SESSION['loggedInUser'] = $user;

        // Guardem el nou rol
        $_SESSION['rol'] = $user['rol'];

        if ($user['rol'] === 'admin' || $user['rol'] === 'user') {
            header('Location: /templates/navbar_normal.php');
            exit();
        } else {
            echo "No tens acces";
        }
    } else {
        echo "Usuari o contrasenya incorrectes. Siusplau intenta'ho de nou.";
    }
} else {
    header('Location: ../views/login_view.php');
    exit();
}
?>
