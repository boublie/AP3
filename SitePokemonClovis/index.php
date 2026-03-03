<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>PokéPlush - Accueil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav>
        <a href="index.php">Accueil</a> | 
        <a href="produits.php">Produits</a> | 
        <a href="categories.php">Catégories</a> | 
        <a href="clients.php">Clients</a>
    </nav>

    <h1>Bienvenue sur PokéPlush</h1>
    <p>Utilisez notre Pokédex pour trouver la peluche de vos rêves :</p>

    <form action="pokemon.php" method="POST">
        <label for="pokemon">Choisis un Pokémon :</label><br><br>

        <select name="id_pokemon" id="pokemon" required>
            <option value="">-- Sélectionner --</option>
            <option value="1">Bulbizarre</option>
            <option value="4">Salamèche</option>
            <option value="7">Carapuce</option>
            <option value="25">Pikachu</option>
        </select><br><br>

        <input type="submit" value="Voir la peluche">
    </form>

</body>
</html>