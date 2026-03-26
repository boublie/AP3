<?php 
include 'includes/db.php'; 
include 'includes/header.php'; 

// 1. On récupère la recherche si l'utilisateur a tapé un nom
$recherche = $_GET['search'] ?? '';

// 2. LA REQUÊTE SQL "MAGIQUE" (Jointure)
// On demande le produit (p.*) ET on regroupe les types (GROUP_CONCAT)
$sql = "SELECT p.*, 
        GROUP_CONCAT(t.libelle_type) as noms_types, 
        GROUP_CONCAT(t.couleur_css) as couleurs_types
        FROM produit p
        LEFT JOIN posseder pos ON p.ref_produit = pos.ref_produit
        LEFT JOIN type t ON pos.id_type = t.id_type";

// Si on recherche un nom, on ajoute une condition WHERE
if (!empty($recherche)) {
    $sql .= " WHERE p.nom LIKE :search GROUP BY p.ref_produit ORDER BY p.num_pokedex ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['search' => "%$recherche%"]);
} else {
    // Sinon on affiche tout, groupé par Pokémon
    $sql .= " GROUP BY p.ref_produit ORDER BY p.num_pokedex ASC";
    $stmt = $pdo->query($sql);
}

$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <div class="mb-5">
        <h1 class="fw-bold text-white text-uppercase">Pokédex Officiel</h1>
        <p class="text-secondary">Système de gestion des peluches synchronisé</p>
    </div>

    <!-- BARRE DE RECHERCHE -->
    <form method="GET" class="mb-5">
        <div class="input-group">
            <input type="text" name="search" class="form-control bg-dark text-white border-secondary" 
                   placeholder="Rechercher un Pokémon..." value="<?= htmlspecialchars($recherche) ?>">
            <button class="btn btn-danger fw-bold" type="submit">SCANNER</button>
        </div>
    </form>

    <!-- GRILLE DES PRODUITS -->
    <div class="row g-4">
        <?php if (count($produits) > 0): ?>
            <?php foreach ($produits as $p): ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="pokemon-card d-flex flex-column h-100">
                    
                    <!-- Numéro -->
                    <div class="pokemon-number">#<?= str_pad($p['num_pokedex'], 3, "0", STR_PAD_LEFT) ?></div>
                    
                    <!-- Image -->
                    <div class="pokemon-img-container text-center my-3">
                        <img src="<?= $p['image'] ?>" class="img-fluid" style="max-height: 150px;">
                    </div>

                    <!-- Nom -->
                    <h5 class="fw-bold text-white text-uppercase"><?= htmlspecialchars($p['nom']) ?></h5>
                    
                    <!-- AFFICHAGE DES TYPES DYNAMIQUES -->
                    <div class="mb-3">
                        <?php 
                        if (!empty($p['noms_types'])) {
                            // On transforme la liste "Plante,Poison" en tableau PHP
                            $noms = explode(',', $p['noms_types']);
                            $couleurs = explode(',', $p['couleurs_types']);
                            
                            foreach ($noms as $index => $nom_t) {
                                echo '<span class="badge me-1" style="font-size:0.7rem; background-color:' . $couleurs[$index] . '; border: 1px solid rgba(255,255,255,0.2);">' . strtoupper($nom_t) . '</span>';
                            }
                        } else {
                            echo '<span class="badge bg-secondary" style="font-size:0.7rem;">NORMAL</span>';
                        }
                        ?>
                    </div>

                    <!-- Stock & Prix -->
                    <div class="mt-auto d-flex justify-content-between align-items-center pt-3 border-top border-secondary">
                        <div class="price-text"><?= $p['prix'] ?> €</div>
                        <a href="pokemon.php?id=<?= $p['ref_produit'] ?>" class="cart-btn text-decoration-none">🛒</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <h3 class="text-secondary small">AUCUNE DONNÉE TROUVÉE DANS LE POKÉDEX...</h3>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>