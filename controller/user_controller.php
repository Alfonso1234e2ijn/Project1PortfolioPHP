<?php
// user_controller.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


function login($username, $password) {
    if (userExist($username)) { // Check if the user exists
        if (credentialsOk($username, $password)) { // Check if credentials are valid
            return getUserByName($username); // Return user data if valid
        }
    }
    return null; // Return null if not found or invalid
}

function mailExist($mail) {
    if (isset($_SESSION['users']) && is_array($_SESSION['users'])) {
        foreach ($_SESSION['users'] as $user) {
            if ($mail == $user['mail']) {
                return true; // Return true if mail exists
            }
        }
    }
    return false; // Return false if not found
}

// User access functions
function userExist($username) {
    if (isset($_SESSION['users']) && is_array($_SESSION['users'])) {
        foreach ($_SESSION['users'] as $user) {
            if ($username === $user['username']) {
                return true; // Return true if user exists
            }
        }
    }
    return false; // Return false if not found
}

function credentialsOk($username, $password) {
    if (isset($_SESSION['users']) && is_array($_SESSION['users'])) {
        foreach ($_SESSION['users'] as $user) {
            // Verify username and hashed password
            if ($username === $user['username'] && $password=== $user['password']) {
                return true; // Return true if valid
            }
        }
    }
    return false; // Return false if invalid
}

function getUserByName($username) {
    if (isset($_SESSION['users']) && is_array($_SESSION['users'])) {
        foreach ($_SESSION['users'] as $user) {
            if ($username === $user['username']) {
                return $user; // Return the user data
            }
        }
    }
    return null; // Return null if not found
}
