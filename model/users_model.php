<?php
// users_initialization.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// Define users
$users = [
    [
        "id" => 0,
        "name" => "Toni Fernandez",
        "username" => "admin",
        "password" => "admin123",
        "mail" => "toni.fernandez@cirvianum.cat",
        "rol" => "admin"
    ],
    [
        "id" => 1,
        "name" => "Raquel Boronat",
        "username" => "raquel",
        "password" => "123",
        "mail" => "raquel.boronat@cirvianum.cat",
        "rol" => "user"
    ]
];

// Store users in session
$_SESSION['users'] = $users;
?>