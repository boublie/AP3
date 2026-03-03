<?php
// On définit les types pour l'affichage
$types_disponibles = ["Plante", "Feu", "Eau", "Électrik", "Normal", "Psy", "Poison", "Fée"];

// On crée une liste de noms pour les premiers (optionnel, sinon ça mettra Peluche #1, etc.)
$noms_kanto = [
    1 => "Bulbizarre", 2 => "Herbizarre", 3 => "Florizarre", 4 => "Salamèche", 5 => "Reptincel", 
    6 => "Dracaufeu", 7 => "Carapuce", 8 => "Carabaffe", 9 => "Tortank", 10 => "Chenipan",
    25 => "Pikachu", 133 => "Évoli", 143 => "Ronflex", 150 => "Mewtwo", 151 => "Mew"
];

$produits = [];

// Génération automatique des Pokémon avec la boucle for vu en cours 
for ($i = 1; $i <= 151; $i++) {
    $nom = $noms_kanto[$i] ?? "Peluche #" . $i;
    $type_au_pif = $types_disponibles[array_rand($types_disponibles)];

    $produits[$i] = [
        "id" => $i,
        "nom" => $nom,
        "numero" => str_pad($i, 3, "0", STR_PAD_LEFT),
        "type" => $type_au_pif,
        "prix" => rand(19, 49) . ".99",
        "image" => "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/$i.png"
    ];
}