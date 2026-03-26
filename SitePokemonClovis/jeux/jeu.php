<?php 
include 'includes/db.php';
include 'includes/header.php'; 
?>

<div class="container py-5 text-center">
    <h2 class="text-white fw-bold mb-4 text-uppercase">⚡ VOLTORBE FLIP ⚡</h2>
    
    <div class="pokemon-card p-4 d-inline-block">
        <div id="game-board">
            <!-- Le plateau sera généré par JavaScript -->
        </div>
        
        <div class="mt-4">
            <h4 class="text-warning">Score actuel : <span id="current-score">0</span> 🪙</h4>
            <p class="text-secondary small">Évitez les Voltorbes pour multiplier vos gains !</p>
            <button onclick="initGame()" class="btn btn-danger fw-bold">NOUVELLE PARTIE</button>
        </div>
    </div>
</div>

<script>
let board = [];
let clues = { rows: [], cols: [] };
let score = 0;
let gameOver = false;

function initGame() {
    board = [];
    score = 1;
    gameOver = false;
    document.getElementById('current-score').innerText = "0";
    
    // 1. Créer un tableau 5x5 avec des chiffres et des Voltorbes (0)
    for (let i = 0; i < 5; i++) {
        board[i] = [];
        for (let j = 0; j < 5; j++) {
            let rand = Math.random();
            if (rand < 0.2) board[i][j] = 0; // 20% de Voltorbes
            else if (rand < 0.5) board[i][j] = 1;
            else if (rand < 0.8) board[i][j] = 2;
            else board[i][j] = 3;
        }
    }
    renderBoard();
}

function renderBoard() {
    const container = document.getElementById('game-board');
    container.innerHTML = "";
    
    // Calculer les indices (Somme et nombre de Voltorbes)
    for (let i = 0; i < 5; i++) {
        for (let j = 0; j < 5; j++) {
            const tile = document.createElement('div');
            tile.className = 'tile';
            tile.onclick = () => flip(i, j, tile);
            container.appendChild(tile);
        }
        // Ajouter indice de fin de ligne (Calcul simplifié pour l'exemple)
        const rowClue = document.createElement('div');
        rowClue.className = 'clue';
        rowClue.innerHTML = "<span>Pts: ?</span><span>💣: ?</span>";
        container.appendChild(rowClue);
    }
    // (Il faudrait ajouter la ligne d'indices du bas ici)
}

function flip(r, c, element) {
    if (gameOver || element.classList.contains('flipped')) return;
    
    const val = board[r][c];
    element.classList.add('flipped');
    element.innerText = val === 0 ? "💣" : val;
    
    if (val === 0) {
        element.classList.add('voltorb');
        alert("BOUM ! Vous avez perdu vos jetons !");
        gameOver = true;
        initGame();
    } else {
        score *= val;
        document.getElementById('current-score').innerText = score;
        
        // Si on gagne (exemple : score > 10)
        if (score >= 20) {
            winPoints(score);
        }
    }
}

function winPoints(points) {
    gameOver = true;
    alert("GAGNÉ ! " + points + " jetons ajoutés !");
    
    // Envoyer les points au PHP via AJAX
    fetch('update_jetons.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'points=' + points
    }).then(() => location.reload());
}

initGame();
</script>