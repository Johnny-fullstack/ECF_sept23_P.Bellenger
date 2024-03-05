<?php
include "../../src/pdo.php";
include '../entities/User.php';

if (session_status() == PHP_SESSION_NONE) {
    // Si la session n'est pas déjà démarrée, on la démarre
    session_start();
}

if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $userId = $user->getId();
    $resaId = $_POST['resa_id'];
    $deleteResa = $pdo->prepare('DELETE FROM `user_reservations` WHERE `id_user` = :id_user AND `id_resa` = :id_resa');
    $deleteResa->bindvalue(':id_user', $userId);
    $deleteResa->bindvalue(':id_resa', $resaId);
    $deleteResa->execute();
    header('Location: ../../front/compteHtml.php');
    exit();
} else {
    // Redirigez si l'utilisateur n'est pas connecté
    session_write_close();
    header('Location: ../../front/connexionHtml.php');
    exit();
}