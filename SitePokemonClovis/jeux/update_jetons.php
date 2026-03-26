<?php
include 'includes/db.php';
session_start();

if (isset($_SESSION['client_id']) && isset($_POST['points'])) {
    $points = (int)$_POST['points'];
    $id_client = $_SESSION['client_id'];

    $stmt = $pdo->prepare("UPDATE client SET jetons = jetons + ? WHERE id_client = ?");
    $stmt->execute([$points, $id_client]);
}