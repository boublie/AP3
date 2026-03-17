<?php 
// OBLIGATOIRE : Doit être la toute première ligne pour que la connexion fonctionne
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokéPlush - Pokédex</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Police Pixel -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&swap" rel="stylesheet">
    
    <style>
        /* DESIGN GLOBAL */
        body {
            background-color: #1a1d21 !important;
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* HEADER ROUGE */
        .pokedex-header {
            background-color: #dc0a2d !important;
            border-bottom: 5px solid #8e1a1a;
            padding: 10px 0;
            margin-bottom: 40px;
        }
        .logo-font {
            font-family: 'Press Start 2P', cursive;
            font-size: 0.8rem;
            color: white !important;
            text-decoration: none;
        }

        /* LA CARTE POKÉMON */
        .pokemon-card {
            background: linear-gradient(135deg, #1d4d4f 0%, #0d1a1b 100%);
            border: 2px solid #2d5a5c;
            border-radius: 15px;
            padding: 20px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 10px 20px rgba(0,0,0,0.5);
            height: 100%;
        }

        /* EFFET SCANLINE */
        .pokemon-card::before {
            content: "";
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: repeating-linear-gradient(0deg, rgba(0, 0, 0, 0.1) 0px, rgba(0, 0, 0, 0.1) 1px, transparent 1px, transparent 2px);
            pointer-events: none;
            z-index: 1;
        }

        .pokemon-img-container { position: relative; z-index: 2; transition: transform 0.4s ease; }
        .pokemon-card:hover { transform: translateY(-10px); border-color: #00ffcc; box-shadow: 0 0 20px rgba(0, 255, 204, 0.3); }
        .pokemon-card:hover .pokemon-img-container { transform: scale(1.2) rotate(5deg); }
        .pokemon-number { color: #00ffcc; font-family: monospace; font-weight: bold; font-size: 1.1rem; }
        .price-text { color: #ffca28; font-weight: bold; font-size: 1.3rem; }

        .cart-btn {
            background: #ff1744;
            border: none;
            color: white;
            width: 45px; height: 45px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            text-decoration: none;
        }
        .cart-btn:hover { background: white; color: #ff1744; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg pokedex-header shadow">
  <div class="container">
    <!-- Logo -->
    <a class="logo-font" href="index.php">🔴 PokéPlush</a>
    
    <!-- Bouton mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMenu">
      <!-- Liens Gauche -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link text-white" href="index.php">Accueil</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="produits.php">Pokédex</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="clients.php">Dresseurs</a></li>
      </ul>

      <!-- Liens Droite (Dynamiques) -->
      <div class="d-flex align-items-center">
        <?php if (isset($_SESSION['client_id'])): ?>
            <!-- Si le dresseur est connecté -->
            <span class="text-warning me-3 fw-bold small">Lv.99 <?= strtoupper($_SESSION['client_nom']) ?></span>
            <a href="deconnexion.php" class="btn btn-sm btn-outline-light me-3">Quitter</a>
        <?php else: ?>
            <!-- Si non connecté -->
            <a href="connexion.php" class="btn btn-sm btn-outline-light me-2">Connexion</a>
            <a href="inscription.php" class="btn btn-sm btn-warning fw-bold text-dark">S'inscrire</a>
        <?php endif; ?>

        <!-- Panier -->
        <a href="panier.php" class="text-decoration-none fs-4 ms-2">🛒</a>
      </div>
    </div>
  </div>
</nav>

<!-- Début du contenu des pages -->
<div class="container">