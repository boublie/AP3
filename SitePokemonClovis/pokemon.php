<?php 
include 'data/produits.php';
include 'includes/header.php'; 

$id = $_GET['id'] ?? 1; // On récupère l'ID, par défaut 1 (Bulbizarre)
$p = $produits[$id]; // On cherche le Pokémon correspondant
?>

<div class="container py-5">
    <a href="produits.php" class="btn btn-outline-danger mb-4">← Retour au Pokédex</a>

    <div class="pokemon-card p-5">
        <div class="row align-items-center">
            <!-- Image à gauche -->
            <div class="col-md-5 text-center">
                <div class="pokemon-img-container p-4">
                    <img src="<?= $p['image'] ?>" class="img-fluid" style="max-height: 400px; filter: drop-shadow(0 0 30px rgba(0,255,204,0.4));">
                </div>
            </div>

            <!-- Infos à droite -->
            <div class="col-md-7 ps-md-5">
                <span class="pokemon-number fs-3">#<?= $p['numero'] ?></span>
                <h1 class="display-3 fw-bold text-white text-uppercase"><?= $p['nom'] ?></h1>
                
                <div class="my-4">
                    <span class="badge bg-info p-2 px-4 fs-5 text-dark">TYPE : <?= $p['type'] ?></span>
                    <span class="badge bg-warning p-2 px-4 fs-5 text-dark ms-2">QUALITÉ : Peluche XL</span>
                </div>

                <p class="fs-4 text-secondary">
                    Cette peluche officielle de <?= $p['nom'] ?> est fabriquée en coton ultra-doux. 
                    Idéale pour les dresseurs cherchant un compagnon de route pour leurs aventures à Kanto.
                </p>

                <div class="d-flex align-items-center mt-5">
                    <div class="price-text display-4 me-5"><?= $p['prix'] ?> €</div>
                    <button class="btn btn-danger btn-lg px-5 py-3 fw-bold shadow">AJOUTER AU PANIER</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>