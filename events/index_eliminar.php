<?php
session_start();
include_once '../model/events_model.php';

if (isset($_SESSION['message'])) {
    echo '<div class="message">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
}

// Obtenir llista dels events
$events = getEvents();

// Eliminacio dels events
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event-name'])) {
    $eventName = $_POST['event-name'];
    $deleted = deleteEventByName($eventName);

    if ($deleted) {
        $_SESSION['message'] = "Event '$eventName' eliminat correctament.";
    } else {
        $_SESSION['message'] = "No s'ha trobat l'event '$eventName'.";
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
    <title>Eliminar un Event</title>
    <link rel="stylesheet" href="/events/event_styles/style.css">
</head>

<body>
    <header>
        <h1>Eliminar un Event</h1>
    </header>

    <main>
        <section id="eliminar-event">
            <h2>Formulari d'Eliminació d'Event</h2>
            <form action="" method="post">
                <label for="event-name">Nom de l'event:</label>
                <input type="text" id="event-name" name="event-name" required>

                <input type="submit" value="Eliminar event">
            </form>
        </section>

        <section id="events">
            <h2>Events Afegits</h2>
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