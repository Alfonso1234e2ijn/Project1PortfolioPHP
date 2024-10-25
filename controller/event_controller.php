<?php
session_start();
include_once '../model/events_model.php';

if (!isset($_SESSION['events'])) {
    $_SESSION['events'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['event-name']) && isset($_POST['event-description']) && isset($_POST['event-type'])) {
        $eventName = $_POST['event-name'];
        $eventDescription = $_POST['event-description'];
        $eventType = $_POST['event-type'];

        saveEvent($eventName, $eventDescription, $eventType);

        // Redirigir según el tipo de evento
        // Redirigir segons el tipus d'event
        switch ($eventType) {
            case 'musica':
                header("Location: /events/event_musica.php");
                break;
            case 'cine':
                header("Location: /events/event_cine.php");
                break;
            case 'teatre':
                header("Location: /events/event_teatre.php");
                break;
            default:
                header("Location: /events/index_afegir.php");
                break;
        }
        exit();
    } else {
        echo "Falten dades del formulari.";
    }
}