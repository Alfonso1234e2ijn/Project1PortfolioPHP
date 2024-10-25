<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['events'])) {
    $_SESSION['events'] = [];
}

function generateEventID()
{
    return uniqid();
}

function saveEvent($eventName, $eventDescription, $eventType)
{
    $newEvent = array(
        'id' => generateEventID(),
        'name' => $eventName,
        'description' => $eventDescription,
        'type' => $eventType
    );

    $_SESSION['events'][] = $newEvent;

    $_SESSION['message'] = "Nou event afegit correctament amb ID: " . $newEvent['id'];
}

function getEvents() {
    return $_SESSION['events'] ?? []; // Torna els events desde la sessio
}

function saveEvents($events) {
    $_SESSION['events'] = $events; // Guarda els events en la sessio
}


function deleteEventByName($eventName) {
    $events = getEvents(); // Obtiene los eventos actuales
    foreach ($events as $index => $event) {
        if ($event['name'] === $eventName) {
            unset($events[$index]); // Elimina el evento
            saveEvents(array_values($events)); // Reindexa i guarda els events
            return true; // Retorna true si se eliminó
        }
    }
    return false; // Si no es troba cap event torna false
}
?>