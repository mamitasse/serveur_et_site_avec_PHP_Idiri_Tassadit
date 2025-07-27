<?php
// Paramètres de connexion à MySQL
$serveur = "localhost";
$utilisateur = "root"; // à adapter si différent
$motDePasse = "";       // à adapter si mot de passe existe

try {
    // Connexion au serveur MySQL sans base sélectionnée
    $connexion = new PDO("mysql:host=$serveur", $utilisateur, $motDePasse);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Création de la base de données
    $connexion->exec("CREATE DATABASE IF NOT EXISTS artbox CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
    echo "✅ Base de données 'artbox' créée avec succès ou déjà existante.<br>";

    // Connexion à la base nouvellement créée
    $connexion = new PDO("mysql:host=$serveur;dbname=artbox", $utilisateur, $motDePasse);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Création de la table oeuvres
    $sql = "
        CREATE TABLE IF NOT EXISTS oeuvres (
            id INT AUTO_INCREMENT PRIMARY KEY,
            titre VARCHAR(255) NOT NULL,
           artiste VARCHAR(255) NOT NULL,
            image VARCHAR(255) NOT NULL,
            description TEXT
        )
    ";
    $connexion->exec($sql);
    echo "✅ Table 'oeuvres' créée avec succès ou déjà existante.";
} catch (PDOException $e) {
    echo "❌ Erreur : " . $e->getMessage();
}
