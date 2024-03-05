<?php
include '../pdo.php';
include '../entities/User.php';
include '../entities/Reservation.php';
include 'NbPersTransformer.php';

if (session_status() == PHP_SESSION_NONE) {
    // Si la session n'est pas déjà démarrée, on la démarre
    session_start();
}

// Récupération des données du formulaire
$nom = htmlspecialchars($_POST['nom']);
$mail = htmlspecialchars($_POST['mail']);
$nbPers = htmlspecialchars($_POST['nbpers']);
$date = htmlspecialchars($_POST['jour']);
$periode = htmlspecialchars($_POST['dej_din']);

//Si l'heure de déjeuner ou de diner est renseignée, on la récupère
if (isset($_POST['heure_dej'])) {
    $heureDej = $_POST['heure_dej'];
    $heureDin = 0; // valeur par défaut
} else if (isset($_POST['heure_diner'])) {
    $heureDin = $_POST['heure_diner'];
    $heureDej = 0; // valeur par défaut
} else {
    header('Location: ../../front/reservation/resaHtml.php');
    exit;
}

$allergies = htmlspecialchars($_POST['allergies']);
// Si  allergies est vide, on lui attribue 0
$allergies = $allergies == NULL ? "0" : $allergies;
// Transformation de la valeur de nbPers en entier
$intNbPers = NbPersTransformer::reverseTransform($nbPers);

echo $intNbPers, $date, $periode, $heureDej, $heureDin, $allergies;

// Insertion des données en la table reservations
$insertResa = 'INSERT INTO `reservations` (`nom`, `email`, `nbpers`, `jour`, `heure_dej`, `heure_diner`, `allergies`) VALUES (?, ?, ?, ?, ?, ?, ?)';
$resaStatement = $pdo->prepare($insertResa);
$resaStatement->execute([$nom, $mail, $intNbPers, $date, $heureDej, $heureDin, $allergies]);
// Récupère l'id de la dernière reservation enregistré
$lastId = $pdo->lastInsertId();

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
    } else if ($couvertStatement->rowCount() == 0) {
        // Si aucune entrée correspondante n'est trouvée dans la table `couverts`
        // Récupère le nombre total de couverts pour le soustraire du nombre de couverts restants
        $couvertStatement = $pdo->prepare('SELECT `couverts_total` FROM `couverts` WHERE `id` = 1');
        $couvertStatement->execute();
        $requestResult = $couvertStatement->fetch(PDO::FETCH_ASSOC);
        $couvertsTotal = $requestResult['couverts_total'];
        $couvertRestant = $couvertsTotal;
        // nouvelle entrée
        $insertCouvert = 'INSERT INTO `couverts` (`jour`, `dej_din`, `couverts_restant`) VALUES (?, ?, ?)';
        $insertCouvertStatement = $pdo->prepare($insertCouvert);
        $insertCouvertStatement->execute([$date, $periode, $couvertRestant - $intNbPers]);
    } else {
        // Si la requête a échoué
        $_SESSION['message_error'] = "Quelque chose à échoué.";
        session_write_close();
        header('Location: ../../front/reservation/resaHtml.php');
        exit;
    }

if ($resaStatement->rowCount() == 1) {

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
              
    } else {
        // Si l'objet User n'est pas défini dans la session
        $resa = new Resa($lastId, $nom, $mail, $nbPers, $date, $heureDej, $heureDin, (string)$allergies);
        $_SESSION['resa']= $resa;

    }
    
    session_write_close();
    header('Location: ../../front/reservation/validResaHtml.php');
    exit;
} else {
    // La requête a échoué
    $_SESSION['message_error'] = "L'enregistrement de votre réservation a échoué.";
    session_write_close();
    header('Location: ../../front/reservation/erreurInsertHtml.php');
    exit;
}