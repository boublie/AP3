<?php 
include '../includes/db.php'; // On remonte d'un dossier pour la DB
include '../includes/header.php'; 
?>

<div class="container py-5 text-center">
    <div class="mb-4">
        <h1 class="logo-font text-danger" style="font-size: 2rem;">VOLTORB FLIP</h1>
        <p class="text-secondary">Gagne des jetons pour acheter des peluches !</p>
    </div>

    <!-- Le plateau de jeu -->
    <div class="pokemon-card p-4 d-inline-block shadow-lg">
        <div id="game-board">
            <!-- Sera généré par script.js -->
        </div>
        
        <div class="d-flex justify-content-between align-items-center mt-4 px-3">
            <div class="text-start">
                <h5 class="text-white mb-0">TOTAL JETONS</h5>
                <h3 class="text-warning fw-bold" id="total-jetons">
                    <?= $_SESSION['client_jetons'] ?? 0 ?> 🪙
                </h3>
            </div>
            <div>
                <h5 class="text-white mb-0">SCORE PARTIE</h5>
                <h3 class="text-info fw-bold" id="current-score">1</h3>
            </div>
            <button onclick="initGame()" class="btn btn-danger btn-lg fw-bold border-white">RESET</button>
        </div>
    </div>
</div>

<!-- On lie tes fichiers -->
<link rel="stylesheet" href="style.css">
<script src="script.js"></script>

<?php include '../includes/footer.php'; ?>