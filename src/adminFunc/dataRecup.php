<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'db_quaiantique';

$pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

if (session_status() == PHP_SESSION_NONE) {
    // Si la session n'est pas déjà démarrée, on la démarre
    session_start();
}

//récupération du nombre de couvert maximum actuel
$couvertTotalStatement = $pdo->prepare('SELECT `couverts_total` FROM `couverts` WHERE `id` = 1');
$couvertTotalStatement->execute();

if($couvertTotalStatement->rowCount() == 1) {
    $requestResult = $couvertTotalStatement->fetch(PDO::FETCH_ASSOC);
    $couvertsTotal = $requestResult['couverts_total'];
}

//récupération des infos photos actuel
$photoStatement = $pdo->prepare('SELECT * FROM `photos`');
$photoStatement->execute();

function affichagePhoto($photoStatement) {
    $tablePhotos = [];
    echo '<p>';
    if($photoStatement->rowCount() > 0) {
        $tablePhotos = $photoStatement->fetchAll(PDO::FETCH_ASSOC);
        foreach($tablePhotos as $photo ) {
        $idPhoto = $photo['id'];
        $titrePlat = $photo['plat'];
        echo "photo n°$idPhoto : $titrePlat</br>";
        }
    echo '</p>';
    }
}

//récupération des infos horaires actuel
$horaireStatement = $pdo->prepare('SELECT * FROM `horaires`');
$horaireStatement->execute();

if($horaireStatement->rowCount() == 1) {
    $tableHoraires = $horaireStatement->fetch(PDO::FETCH_ASSOC);
    $dejOuv = $tableHoraires['dej_ouverture'];
    $dejFerm = $tableHoraires['dej_fermeture'];
    $dinOuv = $tableHoraires['din_ouverture'];
    $dinFerm = $tableHoraires['din_fermeture'];
} else {
    echo "Erreur dans la récupération des horaires";
}






    

