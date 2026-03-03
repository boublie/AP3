<?php
// On récupère le choix de l'utilisateur
if (!isset($_POST["id_pokemon"])) {
    header("Location: index.php");
    exit;
}

// Tes données de peluches (Pokédex)
$produits = [
    1 => ["numero" => "001", "nom" => "Peluche Bulbizarre", "type" => "Plante / Poison", "prix" => 24.99, "taille" => "25 cm"],
    4 => ["numero" => "004", "nom" => "Peluche Salamèche", "type" => "Feu", "prix" => 22.99, "taille" => "23 cm"],
    7 => ["numero" => "007", "nom" => "Peluche Carapuce", "type" => "Eau", "prix" => 23.99, "taille" => "24 cm"],
    25 => ["numero" => "025", "nom" => "Peluche Pikachu", "type" => "Électrik", "prix" => 26.99, "taille" => "30 cm"]
];

$id = $_POST["id_pokemon"];
$produit = $produits[$id];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $produit["nom"]; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav>
        <a href="index.php">Accueil</a> | <a href="produits.php">Produits</a> | <a href="categories.php">Catégories</a> | <a href="clients.php">Clients</a>
    </nav>

    <h1>Fiche Produit</h1>

    <div style="border: 1px solid #000; padding: 20px; width: 300px;">
        <h2><?php echo $produit["nom"]; ?></h2>
        <p><strong>Numéro Pokédex :</strong> <?php echo $produit["numero"]; ?></p>
        <p><strong>Type :</strong> <?php echo $produit["type"]; ?></p>
        <p><strong>Taille :</strong> <?php echo $produit["taille"]; ?></p>
        <p><strong>Prix :</strong> <?php echo $produit["prix"]; ?> €</p>

        <button onclick="alert('Article ajouté au panier (simulation)')">Ajouter au panier</button>
    </div>

    <br>
    <a href="index.php">Retour au choix</a>

</body>
</html>