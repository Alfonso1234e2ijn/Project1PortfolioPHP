<?php
session_start();
unset($_SESSION['loggedInUser']);
header('Location: ../view/login_view.php');
?>