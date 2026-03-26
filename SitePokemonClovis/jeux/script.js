let board = [];
let score = 1;
let gameOver = false;

function initGame() {
    board = [];
    score = 1;
    gameOver = false;
    document.getElementById('current-score').innerText = "1";
    
    // 1. Créer la matrice 5x5
    for (let r = 0; r < 5; r++) {
        board[r] = [];
        for (let c = 0; c < 5; c++) {
            let rand = Math.random();
            if (rand < 0.2) board[r][c] = 0; // Voltorbe
            else if (rand < 0.6) board[r][c] = 1;
            else if (rand < 0.85) board[r][c] = 2;
            else board[r][c] = 3;
        }
    }
    renderBoard();
}

function renderBoard() {
    const container = document.getElementById('game-board');
    container.innerHTML = "";

    // Création des cases 5x5 + Indices
    for (let r = 0; r < 5; r++) {
        for (let c = 0; c < 5; c++) {
            const tile = document.createElement('div');
            tile.className = 'tile';
            tile.dataset.row = r;
            tile.dataset.col = c;
            tile.onclick = () => flipTile(r, c, tile);
            container.appendChild(tile);
        }

        // --- INDICE DE LIGNE (à droite) ---
        let rowSum = 0;
        let rowBombs = 0;
        for(let i=0; i<5; i++) {
            rowSum += (board[r][i] === 0 ? 0 : board[r][i]);
            if(board[r][i] === 0) rowBombs++;
        }
        const clue = document.createElement('div');
        clue.className = 'clue';
        clue.style.backgroundColor = "#ffccbc";
        clue.innerHTML = `<span>${rowSum}</span><span style="color:red">💣${rowBombs}</span>`;
        container.appendChild(clue);
    }

    // --- INDICES DE COLONNES (en bas) ---
    for (let c = 0; c < 5; c++) {
        let colSum = 0;
        let colBombs = 0;
        for(let i=0; i<5; i++) {
            colSum += (board[i][c] === 0 ? 0 : board[i][c]);
            if(board[i][c] === 0) colBombs++;
        }
        const clue = document.createElement('div');
        clue.className = 'clue';
        clue.style.backgroundColor = "#bbdefb";
        clue.innerHTML = `<span>${colSum}</span><span style="color:red">💣${colBombs}</span>`;
        container.appendChild(clue);
    }
    
    // Case vide en bas à droite
    const empty = document.createElement('div');
    empty.innerText = "X";
    container.appendChild(empty);
}

function flipTile(r, c, element) {
    if (gameOver || element.classList.contains('flipped')) return;

    const value = board[r][c];
    element.classList.add('flipped');
    
    if (value === 0) {
        element.innerHTML = "💣";
        element.classList.add('voltorb');
        gameOver = true;
        alert("BOUM ! Le Voltorbe a explosé ! Score perdu.");
        setTimeout(initGame, 1000);
    } else {
        element.innerText = value;
        if (value > 1) {
            score *= value;
            document.getElementById('current-score').innerText = score;
        }
        checkWin();
    }
}

function checkWin() {
    // Si tu as un score élevé ou que tu décides de t'arrêter (tu peux ajouter un bouton "Quitter")
    if (score >= 50) {
        alert("BIEN JOUÉ ! Tu gagnes " + score + " jetons !");
        savePoints(score);
    }
}

function savePoints(p) {
    // Appel PHP pour ajouter les jetons en base de données
    fetch('../update_jetons.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'points=' + p
    }).then(() => location.reload());
}

initGame();