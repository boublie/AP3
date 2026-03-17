<?php include 'includes/header.php'; ?>

<div class="container py-5 text-center">
    <div class="py-5">
        <h1 class="logo-font display-1 text-danger mb-4" style="font-size: 3rem;">POKÉPLUSH</h1>
        <p class="lead text-secondary mb-5">Bienvenue dans le système de gestion de peluches Kanto v1.0</p>
        
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="pokemon-card p-5">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" class="img-fluid mb-4" style="width: 100px; animation: bounce 2s infinite;">
                    <h3>SYSTÈME PRÊT</h3>
                    <p class="text-secondary mb-4">151 Pokémon répertoriés dans la base de données.</p>
                    <a href="produits.php" class="btn btn-danger btn-lg w-100 py-3 fw-bold">ACCÉDER AU POKÉDEX</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
}
</style>

<?php include 'includes/footer.php'; ?>