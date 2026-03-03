<?php 
include 'includes/header.php'; 
include 'data/produits.php'; 
?>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-danger">LISTE DES POKÉMON</h1>
        <span class="badge bg-dark p-2">151 résultats</span>
    </div>

    <div class="row">
        <?php foreach ($produits as $p): ?>
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <div class="card poke-card h-100">
                    <div class="poke-img-container text-center">
                        <img src="<?= $p['image'] ?>" class="img-fluid" alt="<?= $p['nom'] ?>" style="max-height: 150px;">
                    </div>
                    <div class="card-body text-center pt-0">
                        <small class="text-muted fw-bold">#<?= $p['numero'] ?></small>
                        <h5 class="card-title fw-bold text-uppercase"><?= $p['nom'] ?></h5>
                        <p class="badge bg-secondary"><?= $p['type'] ?></p>
                        <p class="text-danger fw-bold fs-5"><?= $p['prix'] ?> €</p>
                        <a href="pokemon.php?id=<?= $p['id'] ?>" class="btn btn-pokedex w-100">DÉTAILS</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>