<?php require 'header.php'; ?>
<?php require 'bdd.php'; ?>

<?php
$db = connexion(); // Connexion à la BDD

// Récupération des œuvres depuis MySQL
$stmt = $db->query("SELECT * FROM oeuvres");
$oeuvres = $stmt->fetchAll();
?>

<main>
    <div id="liste-oeuvres">
        <?php foreach ($oeuvres as $oeuvre) : ?>
            <a href="oeuvre.php?id=<?= htmlspecialchars($oeuvre['id']) ?>" class="oeuvre">
                <img src="<?= htmlspecialchars($oeuvre['image']) ?>" alt="<?= htmlspecialchars($oeuvre['titre']) ?>">
                <h2><?= htmlspecialchars($oeuvre['titre']) ?></h2>
                <p><?= htmlspecialchars($oeuvre['artiste']) ?></p>
            </a>
        <?php endforeach; ?>
    </div>
</main>

<?php require 'footer.php'; ?>

