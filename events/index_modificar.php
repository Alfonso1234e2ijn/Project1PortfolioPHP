<?php
session_start();
include_once '../model/events_model.php';

if (isset($_SESSION['message'])) {
    echo '<div class="message">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
}

// Obtener la lista de eventos
$events = getEvents();
$eventToEdit = null; // Para almacenar el evento que se va a modificar

// Buscar el evento a modificar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search-event-name'])) {
    $searchEventName = $_POST['search-event-name'];

    foreach ($events as $event) {
        if ($event['name'] === $searchEventName) {
            $eventToEdit = $event; // Almacenar el evento que coincide
            break;
        }
    }

    if (!$eventToEdit) {
        $_SESSION['message'] = "No s'ha trobat l'event '$searchEventName'.";
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
}

// Modificar el evento
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event-id']) && isset($_POST['new-event-name'])) {
    $eventId = $_POST['event-id'];
    $newEventName = $_POST['new-event-name'];
    $newEventDescription = $_POST['new-event-description'];
    $newEventType = $_POST['new-event-type'];

    $modified = false;

    foreach ($events as &$event) {
        if ($event['id'] === $eventId) {
            // Actualizar los detalles del evento
            $event['name'] = $newEventName;
            $event['description'] = $newEventDescription;
            $event['type'] = $newEventType;
            $modified = true;
            break;
        }
    }

    if ($modified) {
        saveEvents($events); // Guardar los cambios en la sesión
        $_SESSION['message'] = "Event '$newEventName' modificat correctament.";
    } else {
        $_SESSION['message'] = "No s'ha pogut modificar l'event.";
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar un Event</title>
    <link rel="stylesheet" href="/events/event_styles/style.css">
</head>

<body>
    <header>
        <h1>Modificar un Event</h1>
    </header>

    <main>
        <section id="modificar-event">
            <h2>Buscar Event per Modificar</h2>
            <form action="" method="post">
                <label for="search-event-name">Nom de l'event:</label>
                <input type="text" id="search-event-name" name="search-event-name" required>
                <input type="submit" value="Buscar event">
            </form>
        </section>

        <?php if ($eventToEdit): ?>
            <section id="editar-event">
                <h2>Modificar Detalls de l'Event</h2>
                <form action="" method="post">
                    <input type="hidden" name="event-id" value="<?php echo htmlspecialchars($eventToEdit['id']); ?>">

                    <label for="new-event-name">Nou Nom de l'event:</label>
                    <input type="text" id="new-event-name" name="new-event-name"
                        value="<?php echo htmlspecialchars($eventToEdit['name']); ?>" required>

                    <label for="new-event-description">Nova Descripció:</label>
                    <input type="text" id="new-event-description" name="new-event-description"
                        value="<?php echo htmlspecialchars($eventToEdit['description']); ?>" required>

                    <label for="new-event-type">Nou Tipus:</label>
                    <input type="text" id="new-event-type" name="new-event-type"
                        value="<?php echo htmlspecialchars($eventToEdit['type']); ?>" required>

                    <input type="submit" value="Modificar event">
                </form>
            </section>
        <?php endif; ?>

        <section id="events">
            <h2>Llista d'Events</h2>
            <?php if (!empty($events)): ?>
                <ul>
                    <?php foreach ($events as $event): ?>
                        <li>
                            <strong><?php echo htmlspecialchars($event['name']); ?></strong> (ID:
                            <?php echo htmlspecialchars($event['id']); ?>) -
                            <?php echo htmlspecialchars($event['description']); ?> -
                            Tipus: <?php echo htmlspecialchars($event['type'] ?? 'Desconegut'); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No s'han afegit events encara.</p>
            <?php endif; ?>
        </section>
    </main>
    <nav>
        <ul>
            <li><a href="../templates/navbar_normal.php">Tornar a l'inici</a></li>
        </ul>
    </nav>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Festival de Música. Tots els drets reservats.</p>
    </footer>
</body>

</html>