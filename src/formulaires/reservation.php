<?php
include '../entities/User.php';
include '../entities/Reservation.php';
include 'NbPersTransformer.php';

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=db_quaiantique', 'root', '');

session_start();

// Récupération des données du formulaire
$nom = $_POST['nom'];
$mail = $_POST['mail'];
$nbPers = $_POST['nbpers'];
$date = $_POST['jour'];
$periode = $_POST['dej_din'];
if (isset($_POST['heure_dej'])) {
    // La clé 'heure_dej' existe dans $_POST
    $heureDej = $_POST['heure_dej'];
    $heureDin = 0; // valeur par défaut
} else if (isset($_POST['heure_diner'])) {
    // La clé 'heure_diner' existe dans $_POST
    $heureDin = $_POST['heure_diner'];
    $heureDej = 0; // valeur par défaut
} else {
    header('Location: ../../front/reservation/resaHtml.php');
    exit;
}
$allergies = $_POST['allergies'];
$allergies = $allergies == NULL ? "0" : $allergies;

$intNbPers =  NbPersTransformer::reverseTransform($nbPers);

// Insertion des données en la table reservations
$insertResa = 'INSERT INTO `reservations` (`nom`, `email`, `nbpers`, `jour`, `heure_dej`, `heure_diner`, `allergies`) VALUES (?, ?, ?, ?, ?, ?, ?)';
$resaStatement = $pdo->prepare($insertResa);
$resaStatement->execute([$nom, $mail, $intNbPers, $date, $heureDej, $heureDin, $allergies]);

//Recherche du nombre de places restantes
$couvertStatement = $pdo->prepare('SELECT * FROM `couverts` WHERE `jour` = :jour AND `dej_din` = :dej_din');
$couvertStatement->bindValue(':jour', $date);
$couvertStatement->bindValue(':dej_din', $periode);
$couvertStatement->execute();

if ($couvertStatement->rowCount() == 1) {
     // Si une entrée correspondante est trouvée dans la table `couverts`
    $requestResult = $couvertStatement->fetch(PDO::FETCH_ASSOC);
    $couvertRestant = $requestResult['couverts_restant'];

    // Mettre à jour le nombre de couverts restants
    $updateCouvert = 'UPDATE `couverts` SET `couverts_restant` = ? WHERE `jour` = ? AND `dej_din` = ?';
    $updateCouvertStatement = $pdo->prepare($updateCouvert);
    $updateCouvertStatement->execute([$couvertRestant - $intNbPers, $date, $periode]);
} else {
    $couvertStatement = $pdo->prepare('SELECT `couverts_total` FROM `couverts` WHERE `id` = 1');
    $couvertStatement->execute();
    $requestResult = $couvertStatement->fetch(PDO::FETCH_ASSOC);
    $couvertsTotal = $requestResult['couverts_total'];

    $couvertRestant = $couvertsTotal;
    // Si aucune entrée correspondante n'est trouvée, insérez une nouvelle entrée
    $insertCouvert = 'INSERT INTO `couverts` (`jour`, `dej_din`, `couverts_restant`) VALUES (?, ?, ?)';
    $insertCouvertStatement = $pdo->prepare($insertCouvert);
    $insertCouvertStatement->execute([$date, $periode, $couvertRestant - $intNbPers]);
}

if ($resaStatement->rowCount() == 1) {
    // Récupère l'id de la dernière reservation enregistré
    $lastId = $pdo->lastInsertId();

    // Vérifie que l'objet User est défini dans la session
    if (isset($_SESSION['user'])) {
        
        // Récupère les données de user
        $user = $_SESSION['user'];
       
        // Récupère la dernière réservation 
        $resaId = $pdo->prepare('SELECT `id` FROM `reservations` WHERE `id` = :id');
        $resaId->bindvalue(':id', $lastId); 

        // Insert l'id resa associé à l'id user dans la table user_reservations
        $insertUserResa = 'INSERT INTO `user_reservations` (`id_user`, `id_resa`) VALUES (?, ?)';
        $userResaStatement = $pdo->prepare($insertUserResa);
        $userResaStatement->execute([$user->getId(), $lastId]);
        var_dump($user->getId());
        $userResa= new UserResa($lastId, $nom, $mail, $nbPers, $date, $heureDej, $heureDin, (string)$allergies, (int)$user->getId());
        $_SESSION['userResa']= $userResa; 
              
    }else {
        $resa = new Resa($lastId, $nom, $mail, $nbPers, $date, $heureDej, $heureDin, (string)$allergies);
        $_SESSION['resa']= $resa;

    }
    
    session_write_close();
    header('Location: ../../front/reservation/validResaHtml.php');
    exit;
} else {
    // La requête a échoué
    $errorInfo = $statement->errorInfo();
    error_log('SQLSTATE : ' . $errorInfo[0] . PHP_EOL .
    'Erreur du driver : ' . $errorInfo[1] . PHP_EOL .
    'Message : ' . $errorInfo[2]);
}