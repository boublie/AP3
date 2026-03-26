<?php 
include 'includes/db.php';
include 'includes/header.php'; 

if (!isset($_SESSION['client_id'])) { header("Location: connexion.php"); exit(); }

$id_client = $_SESSION['client_id'];
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $ville = $_POST['ville'];
    $avatar = $_POST['avatar'];

    $update = $pdo->prepare("UPDATE client SET nom = ?, ville = ?, avatar = ? WHERE id_client = ?");
    $update->execute([$nom, $ville, $avatar, $id_client]);
    
    // Mise à jour de la session pour le Header
    $_SESSION['client_nom'] = $nom;
    $_SESSION['client_avatar'] = $avatar;
    $message = "<div class='alert alert-success'>Profil mis à jour, dresseur !</div>";
}

$stmt = $pdo->prepare("SELECT * FROM client WHERE id_client = ?");
$stmt->execute([$id_client]);
$user = $stmt->fetch();

$avatars = ['Ash', 'Misty', 'Brock', 'Gary', 'Oak', 'Joy', 'Jessie', 'James'];
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="pokemon-card p-4">
                <h2 class="text-white fw-bold mb-4">MODIFIER MON PROFIL</h2>
                <?= $message ?>
                <form method="POST">
                    <div class="row">
                        <div class="col-md-4 text-center border-end border-secondary">
                            <img src="https://api.dicebear.com/7.x/pixel-art/svg?seed=<?= $user['avatar'] ?>" id="preview" class="img-fluid rounded bg-dark border border-info mb-3">
                            <input type="hidden" name="avatar" id="avatar_input" value="<?= $user['avatar'] ?>">
                            <div class="d-flex flex-wrap justify-content-center gap-2">
                                <?php foreach($avatars as $a): ?>
                                    <img src="https://api.dicebear.com/7.x/pixel-art/svg?seed=<?= $a ?>" 
                                         style="width: 40px; cursor: pointer; background: #333;" class="rounded"
                                         onclick="document.getElementById('preview').src=this.src; document.getElementById('avatar_input').value='<?= $a ?>';">
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="col-md-8 ps-4">
                            <div class="mb-3">
                                <label class="text-secondary small">NOM</label>
                                <input type="text" name="nom" class="form-control bg-dark text-white border-secondary" value="<?= $user['nom'] ?>">
                            </div>
                            <div class="mb-3">
                                <label class="text-secondary small">VILLE</label>
                                <input type="text" name="ville" class="form-control bg-dark text-white border-secondary" value="<?= $user['ville'] ?>">
                            </div>
                            <button type="submit" class="btn btn-danger w-100 fw-bold py-3 mt-4">SAUVEGARDER</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>