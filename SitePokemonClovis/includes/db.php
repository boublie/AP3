<?php
$host = 'localhost';
$dbname = 'pokeplush';
$username = 'root';
$password = ''; // Par défaut vide sur XAMPP

try {
    // Connexion à la base de données avec gestion des caractères spéciaux (UTF8)
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Configuration pour afficher les erreurs SQL si elles surviennent
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>