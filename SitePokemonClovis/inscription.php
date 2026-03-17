<?php 
include 'includes/db.php';
include 'includes/header.php'; 

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $ville = $_POST['ville'];
    $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO client (nom, email, mdp, ville, nb_badges) VALUES (?, ?, ?, ?, 0)");
        $stmt->execute([$nom, $email, $mdp, $ville]);
        $message = "<div class='alert alert-success'>Compte dresseur créé avec succès ! <a href='connexion.php'>Connecte-toi ici</a></div>";
    } catch (Exception $e) {
        $message = "<div class='alert alert-danger'>Erreur : Cet email est peut-être déjà utilisé.</div>";
    }
}
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="pokemon-card p-4">
                <h2 class="fw-bold text-white mb-4">NOUVEAU DRESSEUR</h2>
                <?= $message ?>
                <form method="POST">
                    <div class="mb-3">
                        <label class="text-secondary small">NOM COMPLET</label>
                        <input type="text" name="nom" class="form-control bg-dark text-white border-secondary" required>
                    </div>
                    <div class="mb-3">
                        <label class="text-secondary small">EMAIL (IDENTIFIANT)</label>
                        <input type="email" name="email" class="form-control bg-dark text-white border-secondary" required>
                    </div>
                    <div class="mb-3">
                        <label class="text-secondary small">VILLE DE DÉPART</label>
                        <input type="text" name="ville" class="form-control bg-dark text-white border-secondary" placeholder="ex: Bourg-Palette">
                    </div>
                    <div class="mb-3">
                        <label class="text-secondary small">MOT DE PASSE</label>
                        <input type="password" name="mdp" class="form-control bg-dark text-white border-secondary" required>
                    </div>
                    <button type="submit" class="btn btn-danger w-100 fw-bold py-3">S'ENREGISTRER</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>