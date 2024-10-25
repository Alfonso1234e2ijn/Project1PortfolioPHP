<?php

function validarContrasenya($contrasenya) {
    // Minim tres caracters
    return strlen($contrasenya) >= 3;
}

function validarcorreu($correu) {
    // Ha de tenir el domini @gmail.com
    return filter_var($correu, FILTER_VALIDATE_EMAIL) && preg_match('/@gmail\.com$/', $correu);
}

function validarUsername($username) {
    // Al menys 5 caracters i no pot tenir simbols especials
    return preg_match('/^[A-Za-z0-9]{5,}$/', $username);
}

//exemple d'us
$contrasenya = 'abc';
$correu = 'ejemplo@gmail.com';

if (validarContrasenya($contrasenya)) {
    echo "La contrasenya es válida.\n";
} else {
    echo "Minim tres caracters.\n";
}

if (validarcorreu($correu)) {
    echo "El correu es válid.\n";
} else {
    echo "Ha de ser @gmail.com.\n";
}
?>
