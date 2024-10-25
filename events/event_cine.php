<?php
session_start();
include_once '../model/events_model.php';

$events = getEvents();
$cineEvents = array_filter($events, function ($event) {
    return isset($event['type']) && $event['type'] === 'cine';
});

$title = "Events de Cine - Festival de Música 2024";
$date = "15 de novembre de 2024";
$location = "Parc Central, Ciutat";
?>

<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="/events/event_styles/style.css">
</head>

<body>
    <header>
        <h1><?php echo $title; ?></h1>
        <p><?php echo "Data: " . date("Y-m-d"); ?></p>
        <p><?php echo "Ubicació: " . $location; ?></p>
    </header>

    <main>
        <section id="events">
            <h2>Events Afegits de Cine</h2>
            <?php if (!empty($cineEvents)): ?>
                <ul>
                    <?php foreach ($cineEvents as $event): ?>
                        <li>
                            <strong>Nom:</strong><?php echo htmlspecialchars($event['name']); ?> -
                            <strong>Descripcio:</strong> <?php echo htmlspecialchars($event['description']); ?> -
                            <strong>Tipus:</strong><?php echo htmlspecialchars($event['type']); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No s'han afegit events de cine encara.</p>
            <?php endif; ?>
        </section>

        <section id="entrades">
            <h2>Tornar a l'inici</h2>
            <a href="../templates/navbar_normal.php">Tornar a l'inici</a>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Festival de Música. Tots els drets reservats.</p>
    </footer>
</body>

</html>