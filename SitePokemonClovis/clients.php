<?php 
include 'includes/db.php';
include 'includes/header.php'; 

// On récupère tous les clients de la base
$query = $pdo->query("SELECT * FROM client ORDER BY nb_badges DESC");
$liste_clients = $query->fetchAll();
?>

<div class="container py-5">
    <h1 class="fw-bold text-white mb-5">CLASSEMENT DES DRESSEURS</h1>
    <div class="row g-4">
        <?php foreach($liste_clients as $c): ?>
        <div class="col-md-6 col-lg-4">
            <div class="pokemon-card p-3">
                <div class="d-flex align-items-center">
                    <img src="https://api.dicebear.com/7.x/pixel-art/svg?seed=<?= $c['nom'] ?>" class="rounded bg-dark border border-secondary me-3" style="width: 70px;">
                    <div>
                        <h4 class="fw-bold text-white mb-0 text-uppercase"><?= $c['nom'] ?></h4>
                        <p class="text-info mb-0">Région : <?= $c['ville'] ?></p>
                        <span class="badge bg-warning text-dark mt-2">⭐ <?= $c['nb_badges'] ?> BADGES</span>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>