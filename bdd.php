<?php
function connexion() {
    $serveur = "localhost";
    $utilisateur = "root";
    $motDePasse = ""; // Laisse vide si tu n’as pas mis de mot de passe
    $base = "artbox";

    try {
        $pdo = new PDO("mysql:host=$serveur;dbname=$base;charset=utf8mb4", $utilisateur, $motDePasse);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("❌ Erreur de connexion à la base de données : " . $e->getMessage());
    }
}
