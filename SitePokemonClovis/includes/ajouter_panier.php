<?php
session_start(); // Nécessaire ici aussi car on est sur un nouveau fichier

$id = $_GET['id'] ?? null; // Récupère l'ID du produit

if ($id) {
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = []; // Crée le panier s'il n'existe pas
    }
    $_SESSION['panier'][] = $id; // Ajoute l'ID au panier
}

// Redirige vers la page précédente (ou index.php si inconnue)
header("Location: " . ($_SERVER['HTTP_REFERER'] ?? 'index.php'));
exit();```
*Vérifie que ce fichier est bien à la racine de ton dossier `SitePokemonClovis`.*

---

### Étape 3 : Le bouton "Ajouter au Panier" sur `produits.php` et `pokemon.php`
Assure-toi que le lien du bouton panier pointe bien vers `ajouter_panier.php` avec le bon ID.

**Dans `produits.php` (dans ta boucle `foreach`) :**
```php
<a href="ajouter_panier.php?id=<?= $p['ref_produit'] ?>" class="cart-btn text-decoration-none">🛒</a>
?>