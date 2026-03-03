<?php 
// 1. Initialisation et récupération des données (INCLUSION ORIGINALE)
include 'data/produits.php'; 

// 2. --- LOGIQUE DE FILTRAGE (NOUVEAU CODE) ---
// On récupère le type dans l'URL (ex: produits.php?type=Feu)
$type_choisi = $_GET['type'] ?? null; 

if ($type_choisi) {
    // On ne garde que les Pokémon qui ont le bon type
    $produits_a_afficher = array_filter($produits, function($p) use ($type_choisi) {
        return $p['type'] === $type_choisi;
    });
} else {
    // Sinon on affiche tout
    $produits_a_afficher = $produits;
}
// ---------------------------

// 3. Inclusion de l'en-tête (INCLUSION ORIGINALE)
include 'includes/header.php'; 
?>

<div class="container py-5">
    
    <div class="mb-5">
        <h1 class="fw-bold text-white">Pokédex</h1>
        <p class="text-secondary">Mode : <?= $type_choisi ? "Filtrage par " . $type_choisi : "Affichage global" ?></p>
    </div>

    <div class="mb-5 d-flex flex-wrap gap-2">
        <a href="produits.php" class="btn btn-outline-light <?= !$type_choisi ? 'active' : '' ?>">Tous</a>
        <?php 
        $types = ["Plante", "Feu", "Eau", "Électrik", "Normal", "Psy", "Poison"];
        foreach($types as $t): 
        ?>
            <a href="produits.php?type=<?= $t ?>" class="btn btn-outline-info <?= $type_choisi == $t ? 'active' : '' ?>">
                <?= $t ?>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="row g-4">
        <?php foreach ($produits_a_afficher as $p): ?> <div class="col-md-3">
                 <div class="pokemon-card d-flex flex-column h-100" onclick="window.location.href='pokemon.php?id=<?= $p['id'] ?>'">
                    <div class="pokemon-number">#<?= $p['numero'] ?></div>
                    <div class="pokemon-img-container text-center my-4">
                        <img src="<?= $p['image'] ?>" class="img-fluid" style="max-height: 160px;">
                    </div>
                    <h5 class="fw-bold text-uppercase text-white mt-2"><?= $p['nom'] ?></h5>
                    <div class="mt-auto d-flex justify-content-between align-items-center pt-3">
                        <div class="price-text"><?= $p['prix'] ?> €</div>
                        <button class="cart-btn">🛒</button>
                    </div>
                 </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

<?php include 'includes/footer.php'; ?>