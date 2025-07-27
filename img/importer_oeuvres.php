<?php
// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$base = "artbox";

try {
    $pdo = new PDO("mysql:host=$serveur;dbname=$base", $utilisateur, $motDePasse);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ✅ Supprimer les anciennes œuvres pour éviter les doublons
    $pdo->exec("DELETE FROM oeuvres");

    // Inclusion du tableau d’œuvres
    include('oeuvre.php');

    if (!isset($oeuvres) || !is_array($oeuvres)) {
        throw new Exception("Le tableau \$oeuvres est introuvable ou mal formé.");
    }

    // Préparer l'insertion
    $stmt = $pdo->prepare("
        INSERT INTO oeuvres (titre, artiste, image, description)
        VALUES (:titre, :artiste, :image, :description)
    ");

    $inserts = 0;

    foreach ($oeuvres as $oeuvre) {
        $stmt->execute([
            ':titre' => $oeuvre['titre'],
            ':artiste' => $oeuvre['artiste'],
            ':image' => $oeuvre['image'],
            ':description' => $oeuvre['description']
        ]);
        $inserts++;
    }

    echo "✅ $inserts œuvres ont été insérées avec succès.";
} catch (PDOException $e) {
    echo "❌ Erreur PDO : " . $e->getMessage();
} catch (Exception $e) {
    echo "❌ Erreur : " . $e->getMessage();
}
?>
