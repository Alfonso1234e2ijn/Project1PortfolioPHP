<?php
session_start();
include("./model/users_model.php");
include("./model/events_model.php");
unset($_SESSION['loggedInUser']);

if (!isset($_SESSION['loggedInUser'])) {
    header('Location: ./view/presentacio_index.php');
    exit();
} else {
    header(header: 'Location: ./templates/navbar_normal.php');
    exit();
}
?>