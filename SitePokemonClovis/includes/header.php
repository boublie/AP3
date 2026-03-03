<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>PokéPlush - Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">🔴 POKÉPLUSH</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
        
        <!-- Menu Déroulant Produits -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Produits</a>
          <ul class="dropdown-menu border-dark">
            <li><a class="dropdown-item" href="produits.php">Tous les produits</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="produits.php?type=Feu">Type Feu</a></li>
            <li><a class="dropdown-item" href="produits.php?type=Eau">Type Eau</a></li>
            <li><a class="dropdown-item" href="produits.php?type=Plante">Type Plante</a></li>
          </ul>
        </li>

        <!-- Menu Déroulant Catégories -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Catégories</a>
          <ul class="dropdown-menu border-dark">
            <li><a class="dropdown-item" href="categories.php?cat=peluches">Peluches</a></li>
            <li><a class="dropdown-item" href="categories.php?cat=figurines">Figurines</a></li>
          </ul>
        </li>

        <li class="nav-item"><a class="nav-link" href="clients.php">Clients</a></li>
      </ul>
      <a href="panier.php" class="btn btn-warning fw-bold border-dark">🛒 PANIER</a>
    </div>
  </div>
</nav>