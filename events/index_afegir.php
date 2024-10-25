<?php
session_start();
include_once '../model/events_model.php';

if (isset($_SESSION['message'])) {
    echo '<div class="message">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
}

$events = getEvents();
?>

<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afegeix un nou event</title>
    <link rel="stylesheet" href="/events/event_styles/style.css">
</head>

<body>
    <header>
        <h1>Afegeix un nou event</h1>
    </header>

    <main>
        <section id="nou-event">
            <h2>Formulari d'Event</h2>
            <form action="/controller/event_controller.php" method="post" enctype="multipart/form-data">
                <label for="event-name">Nom de l'event:</label>
                <input type="text" id="event-name" name="event-name" required>

                <label for="event-description">Descripció de l'Event:</label>
                <textarea id="event-description" name="event-description" rows="4" required></textarea>

                <label for="event-type">Tipus d'Event:</label>
                <select id="event-type" name="event-type" required>
                    <option value="musica">Música</option>
                    <option value="cine">Cine</option>
                    <option value="teatre">Teatre</option>
                </select>

                <input type="submit" value="Afegir event">
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