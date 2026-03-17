<?php 
include 'data/produits.php';
include 'includes/header.php'; 

// On simule un panier avec quelques articles pour l'exemple
$panier_ids = [1, 4, 25]; // Bulbizarre, Salamèche, Pikachu
$total = 0;
?>

<div class="container py-5">
    <div class="mb-5 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="fw-bold text-white">VOTRE INVENTAIRE</h1>
            <p class="text-secondary">Objets prêts pour l'envoi</p>
        </div>
        <a href="produits.php" class="btn btn-outline-info">Continuer la capture</a>
    </div>

    <div class="pokemon-card p-4">
        <table class="table table-dark table-borderless align-middle mb-0">
            <thead class="border-bottom border-secondary">
                <tr class="text-secondary small">
                    <th>PRODUIT</th>
                    <th>NOM</th>
                    <th class="text-center">QUANTITÉ</th>
                    <th class="text-end">PRIX</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($panier_ids as $id): 
                    $p = $produits[$id];
                    $total += (float)$p['prix'];
                ?>
                <tr class="border-bottom border-dark">
                    <td style="width: 100px;">
                        <div class="bg-white rounded p-1" style="width: 60px;">
                            <img src="<?= $p['image'] ?>" class="img-fluid">
                        </div>
                    </td>
                    <td>
                        <span class="fw-bold text-uppercase"><?= $p['nom'] ?></span><br>
                        <small class="text-info">#<?= $p['numero'] ?></small>
                    </td>
                    <td class="text-center">1</td>
                    <td class="text-end fw-bold"><?= $p['prix'] ?> €</td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-outline-danger">❌</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- TOTAL -->
        <div class="row mt-4 pt-3 border-top border-secondary">
            <div class="col-md-6 offset-md-6 text-end">
                <p class="mb-1 text-secondary">SOUS-TOTAL : <span class="text-white"><?= $total ?> €</span></p>
                <p class="mb-1 text-secondary">TAXES (PDC) : <span class="text-white">2.50 €</span></p>
                <h2 class="price-text mt-2">TOTAL : <?= $total + 2.50 ?> €</h2>
                
                <button class="btn btn-danger btn-lg w-100 mt-4 fw-bold py-3 shadow">
                    VALIDER LA COMMANDE (LANCER LA POKÉBALL)
                </button>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>