<?php 
include 'includes/db.php';
include 'includes/header.php'; 

$erreur = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    $stmt = $pdo->prepare("SELECT * FROM client WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($mdp, $user['mdp'])) {
        // Connexion réussie : on stocke les infos dans la SESSION
        $_SESSION['client_id'] = $user['id_client'];
        $_SESSION['client_nom'] = $user['nom'];
        header("Location: index.php");
        exit();
    } else {
        $erreur = "<div class='alert alert-danger'>Identifiants incorrects, dresseur.</div>";
    }
}
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