<?php
include "adminFunc/modifNbCouverts.php";

// Récupération du corps de la requête
$body = file_get_contents('php://input');
// Décodage des données JSON
$data = json_decode($body, true); // Le deuxième argument true retourne un tableau associatif

// Récupéreration des données
$dateFormate = $data['param1'];
// Convertion de la date au format MySQL (YYYY-MM-DD)
$date = date('Y-m-d', strtotime(str_replace('/', '-', $dateFormate)));
$periode = $data['param2'];
$nbCouverts = $data['param3'];

// Connexion et récupération à la base de données 
$pdo = new PDO('mysql:host=localhost;dbname=db_quaiantique', 'root', '');
$couvertStatement = $pdo->prepare('SELECT * FROM `couverts` WHERE `jour` = :jour AND `dej_din` = :dej_din');
$couvertStatement->bindValue(':jour', $date);
$couvertStatement->bindValue(':dej_din', $periode);
$couvertStatement->execute();

// Si execute à un résultat  
if($couvertStatement->rowCount() == 1) {
    $requestResult = $couvertStatement->fetch(PDO::FETCH_ASSOC);
    $couvertRestant = $requestResult['couverts_restant'];
} else {
    $couvertStatement = $pdo->prepare('SELECT `couverts_total` FROM `couverts` WHERE `id` = 1');
    $couvertStatement->execute();
    $requestResult = $couvertStatement->fetch(PDO::FETCH_ASSOC);
    $couvertsTotal = $requestResult['couverts_total'];

    $couvertRestant = $couvertsTotal;
}

// Retourner la réponse au format JSON
header('Content-Type: application/json');
echo json_encode($couvertRestant);