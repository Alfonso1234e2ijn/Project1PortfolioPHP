<?php
// register_controller.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("../controller/user_controller.php");

function validarContrasenya($contrasenya) {
    return strlen($contrasenya) >= 3;
}

function validarUsername($username) {
    return preg_match('/^[A-Za-z0-9]{5,}$/', $username);
}

function validarCorreu($correu) {
    return filter_var($correu, FILTER_VALIDATE_EMAIL) && preg_match('/@gmail\.com$/', $correu);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['mail']) && isset($_POST['name'])) {
        // Obtenir les dades del formulari
        $user = trim($_POST['username']);
        $pass = trim($_POST['password']);
        $name = trim($_POST['name']);
        $mail = trim($_POST['mail']);

        // Validar la contrasenya
        if (!validarContrasenya($pass)) {
            $_SESSION['error'] = 'La contrasenya ha de tenir mínim 3 caràcters.';
            header('Location: ../view/register_view.php');
            exit;
        }

        // Validar el correu electrònic
        if (!validarCorreu($mail)) {
            $_SESSION['error'] = 'El correu ha de ser @gmail.com.';
            header('Location: ../view/register_view.php');
            exit;
        }

        // Validar el nom d'usuari
        if (!validarUsername($user)) {
            $_SESSION['error'] = 'El username ha de tenir mínim 5 caràcters i no pot tenir símbols especials.';
            header('Location: ../view/register_view.php');
            exit;
        }

        // Comprovar si l'usuari ja existeix
        if (userExist($user)) {
            $_SESSION['error'] = 'Usuari ja existent';
            header('Location: ../view/register_view.php');
            exit;
        }

        // Comprovar si el correu ja està en ús
        if (mailExist($mail)) {
            $_SESSION['error'] = 'Correu ja en ús';
            header('Location: ../view/register_view.php');
            exit;
        }

        // Assegurar-se que la clau 'users' existeix en la sessió i que és un array
        if (!isset($_SESSION['users']) || !is_array($_SESSION['users'])) {
            $_SESSION['users'] = []; // Inicialitzar com a array si no està definida
        }

        // Crear un nou usuari
        $newUser = [
            'id' => count($_SESSION['users']), // Assignar ID basat en el recompte d'usuaris actuals
            'name' => $name,
            'username' => $user,
            'password' => $pass,
            'mail' => $mail,
            'rol' => "user"
        ];

        // Afegir el nou usuari a la sessió
        $_SESSION['users'][] = $newUser;

        // Redirigir al login després del registre
        header('Location: ../view/login_view.php');
        exit;
    } else {
        // Si falta algun camp
        $_SESSION['error'] = 'Tots els camps són obligatoris.';
        header('Location: ../view/register_view.php');
        exit;
    }
}
?>
