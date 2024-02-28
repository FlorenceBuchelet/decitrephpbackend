<?php

$allowed_origin = 'http://localhost:5173';
header("Access-Control-Allow-Origin: $allowed_origin");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Specificity, Authorization");
header("Access-Control-Allow-Credentials: true");

// Continue la session de l'utilisateur logué
if (isset($_COOKIE['PHPSESSID'])) {
    session_id($_COOKIE['PHPSESSID']);
    session_start();
}
// else redirect vers création utilisateur

print_r($_POST);
print_r($_SESSION['cart']);


    // if (produit) {$_SESSION['cart']['produit']['quantity'] = $_SESSION['cart']['produit']['quantity'] + 1};
    // if (!produit) {$_SESSION['cart'][] = $newProduct;} + gérer quantité;
    // dans le panier : bouton + et - => $_SESSION['cart']['produit'] +/-1 si 0 => delete
    // C'est ici (enfin en back) que j'utilise la factory pour ajouter directement le produit en entier avec toutes ses caractéristiques ?
    // $newProduct = ProductFactory::createProductFromDatabase()
