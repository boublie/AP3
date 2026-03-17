<?php 
// 1. D'abord la base de données et la session
include 'includes/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$erreur = "";

// 2. LA LOGIQUE DE CONNEXION (Doit être avant le moindre HTML)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    $stmt = $pdo->prepare("SELECT * FROM client WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($mdp, $user['mdp'])) {
        // Connexion réussie
        $_SESSION['client_id'] = $user['id_client'];
        $_SESSION['client_nom'] = $user['nom'];
        
        // ICI la redirection va marcher car le header.php n'est pas encore chargé !
        header("Location: index.php");
        exit(); 
    } else {
        $erreur = "<div class='alert alert-danger'>Identifiants incorrects, dresseur.</div>";
    }
}

// 3. MAINTENANT SEULEMENT, ON APPELLE LE VISUEL
include 'includes/header.php'; 
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="pokemon-card p-4 text-center">
                <h2 class="fw-bold text-white mb-4">CONNEXION</h2>
                <?= $erreur ?>
                <form method="POST">
                    <div class="mb-3 text-start">
                        <label class="text-secondary small">EMAIL</label>
                        <input type="email" name="email" class="form-control bg-dark text-white border-secondary" required>
                    </div>
                    <div class="mb-4 text-start">
                        <label class="text-secondary small">MOT DE PASSE</label>
                        <input type="password" name="mdp" class="form-control bg-dark text-white border-secondary" required>
                    </div>
                    <button type="submit" class="btn btn-danger w-100 fw-bold py-3 mb-3">SE CONNECTER</button>
                    <a href="inscription.php" class="text-info small">Pas encore inscrit ? Créer un compte</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>