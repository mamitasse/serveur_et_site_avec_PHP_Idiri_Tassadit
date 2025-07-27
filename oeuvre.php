<?php
require 'header.php';
require 'bdd.php'; // Connexion à la base

// Si aucun id dans l'URL, on redirige vers l'accueil
if (empty($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}

// Connexion à la base
$db = connexion();

// Préparation de la requête pour récupérer une œuvre par son ID
$stmt = $db->prepare("SELECT * FROM oeuvres WHERE id = ?");
$stmt->execute([$_GET['id']]);
$oeuvre = $stmt->fetch();

// Si aucune œuvre trouvée, on redirige aussi vers l'accueil
if (!$oeuvre) {
    header('Location: index.php');
    exit;
}
?>

<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?= htmlspecialchars($oeuvre['image']) ?>" alt="<?= htmlspecialchars($oeuvre['titre']) ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?= htmlspecialchars($oeuvre['titre']) ?></h1>
        <p class="description"><?= htmlspecialchars($oeuvre['artiste']) ?></p>
        <p class="description-complete">
            <?= nl2br(htmlspecialchars($oeuvre['description'])) ?>
        </p>
    </div>
</article>

<?php require 'footer.php'; ?>
