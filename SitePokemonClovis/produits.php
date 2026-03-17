<?php 
// 1. On inclut la connexion à la base au lieu du fichier data
include 'includes/db.php'; 
include 'includes/header.php'; 

// 2. On prépare la requête SQL pour récupérer tous les produits
$query = $pdo->query("SELECT * FROM produit");
$produits = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="mb-5 mt-5">
    <h1 class="fw-bold">Pokédex</h1>
</div>

<div class="row g-4">
    <?php foreach ($produits as $p): ?>
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        
        <!-- On utilise les noms de colonnes de ta table SQL -->
        <div class="pokemon-card d-flex flex-column">
            
            <div class="pokemon-number">#<?= str_pad($p['num_pokedex'], 3, "0", STR_PAD_LEFT) ?></div>
            
            <div class="pokemon-img-container text-center my-4">
    <!-- On affiche directement le contenu de la colonne 'image' car c'est une URL -->
                <img src="<?= $p['image'] ?>" 
                 class="img-fluid" 
                alt="<?= $p['nom'] ?>" 
                style="max-height: 160px; filter: drop-shadow(0 5px 10px rgba(0,0,0,0.3));">
            </div>

            <h5 class="fw-bold text-uppercase text-white mt-2"><?= $p['nom'] ?></h5>
            
            <div class="mt-auto d-flex justify-content-between align-items-center pt-3">
                <div class="price-text"><?= $p['prix'] ?> €</div>
                <!-- Lien vers la page détail avec l'ID de la base -->
                <a href="pokemon.php?id=<?= $p['ref_produit'] ?>" class="cart-btn text-decoration-none d-flex align-items-center justify-content-center">🛒</a>
            </div>

        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php include 'includes/footer.php'; ?>