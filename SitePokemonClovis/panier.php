<?php 
include 'includes/db.php';
include 'includes/header.php'; // Inclut le session_start() normalement

$panier_ids = $_SESSION['panier'] ?? []; // Récupère les IDs du panier
$total_panier = 0; // Initialise le total

// S'il y a des IDs dans le panier
if (!empty($panier_ids)) {
    // Compte la quantité de chaque produit (si on ajoute 2x Bulbizarre)
    $quantites_par_produit = array_count_values($panier_ids);
    
    // Transforme la liste d'IDs [1, 1, 4] en "1,4" pour la requête SQL
    $ids_uniques = implode(',', array_keys($quantites_par_produit));

    // Récupère les infos complètes des produits dans la base de données
    $stmt = $pdo->query("SELECT ref_produit, nom, prix, image FROM produit WHERE ref_produit IN ($ids_uniques)");
    $produits_details_panier = $stmt->fetchAll(PDO::FETCH_ASSOC);

} else {
    $produits_details_panier = []; // Panier vide
}
?>

<div class="container py-5">
    <h1 class="fw-bold text-white mb-5 text-uppercase">Votre Poké-Sac</h1>

    <?php if (empty($produits_details_panier)): ?>
        <div class="pokemon-card p-5 text-center">
            <h3 class="text-secondary">Votre sac de dresseur est vide...</h3>
            <a href="produits.php" class="btn btn-danger mt-3">Allez capturer des peluches !</a>
        </div>
    <?php else: ?>
        <div class="pokemon-card p-4">
            <table class="table table-dark table-borderless align-middle">
                <thead>
                    <tr class="text-secondary small border-bottom border-secondary">
                        <th>PELUCHE</th>
                        <th>NOM</th>
                        <th>PRIX UNITAIRE</th>
                        <th>QUANTITÉ</th>
                        <th class="text-end">SOUS-TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produits_details_panier as $p): 
                        $quantite = $quantites_par_produit[$p['ref_produit']];
                        $sous_total_produit = $p['prix'] * $quantite;
                        $total_panier += $sous_total_produit;
                    ?>
                    <tr class="border-bottom border-dark">
                        <td><img src="<?= $p['image'] ?>" width="60"></td>
                        <td class="fw-bold text-uppercase"><?= htmlspecialchars($p['nom']) ?></td>
                        <td><?= number_format($p['prix'], 2) ?> €</td>
                        <td>x<?= $quantite ?></td>
                        <td class="text-end fw-bold text-warning"><?= number_format($sous_total_produit, 2) ?> €</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="text-end mt-4">
                <h2 class="price-text display-5">TOTAL DU SAC : <?= number_format($total_panier, 2) ?> €</h2>
                
                <?php if (isset($_SESSION['client_id'])): ?>
                    <form action="valider_commande.php" method="POST">
                        <button type="submit" class="btn btn-danger btn-lg px-5 mt-3 fw-bold shadow">
                            VALIDER L'ACHAT
                        </button>
                    </form>
                <?php else: ?>
                    <div class="alert alert-warning mt-3 bg-dark text-warning border-warning">
                        Connectez-vous pour valider votre achat, dresseur !
                    </div>
                <?php endif; ?>
                
                <a href="vider_panier.php" class="btn btn-sm btn-link text-secondary mt-2">Vider le sac</a>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>