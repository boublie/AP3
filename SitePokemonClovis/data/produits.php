<?php
// On définit les types
$types = ["Feu", "Eau", "Plante", "Électrik", "Psy", "Normal", "Poison"];

// On crée un tableau avec les noms des premiers Pokémon (pour tester plus tard je pourais crée un base de donné dans xamp) 
$noms_pokemon = [
    1 => "Bulbizarre", 2 => "Herbizarre", 3 => "Florizarre", 4 => "Salamèche", 5 => "Reptincel", 
    6 => "Dracaufeu", 7 => "Carapuce", 8 => "Carabaffe", 9 => "Tortank", 10 => "Chenipan",
    25 => "Pikachu", 133 => "Évoli", 143 => "Ronflex", 150 => "Mewtwo"
];

$produits = [];

for ($i = 1; $i <= 151; $i++) {
    // Si le nom n'est pas dans notre liste, on met "Peluche #ID"
    $nom = $noms_pokemon[$i] ?? "Peluche #" . $i;
    
    $produits[$i] = [
        "id" => $i,
        "nom" => $nom,
        "numero" => str_pad($i, 3, "0", STR_PAD_LEFT), // Transforme 1 en 001
        "type" => $types[array_rand($types)], // Type aléatoire pour le test
        "prix" => rand(15, 45) . ".90",
        "image" => "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/$i.png",
        "catégorie" => "peluches"
    ];
}