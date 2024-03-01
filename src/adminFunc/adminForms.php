<?php
if (session_status() == PHP_SESSION_NONE) {
    // Si la session n'est pas déjà démarrée, on la démarre
    session_start();
}

$pdo = new PDO('mysql:host=localhost;dbname=db_quaiantique', 'root', '');

//traitement du formulaire admin changeant le nombre de couvert maximum
if  (isset($_POST['couv_max'])) {
    $nouvCouvertsTotal = htmlspecialchars($_POST['couv_max']);

    $nouvCouvMaxInsert = $pdo->prepare('UPDATE `couverts` SET `couverts_total` = ? WHERE `id` = 1');
    $nouvCouvMaxInsert->execute([$nouvCouvertsTotal]);


    $_SESSION['message_couvert'] = 'La mise à jour des couverts maximum a été effectuée avec succès.';
    session_write_close();
    header('Location: ../../front/utilisateurs/pageAdminHtml.php');   
} else {
    //erreur de téléchargment du fichier
    $_SESSION['message_couvert'] = "La mise à jour des couverts maximum a échoué.";
    session_write_close();
    header('Location: ../../front/utilisateurs/pageAdminHtml.php');
}

//traitement du formulaire admin changeant les photos
if (isset($_FILES['photo'])) {
    $file = $_FILES['photo'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileError = $file['error'];

    $titrePhoto = htmlspecialchars($_POST['plat']);
    $idPhotoRemplace = htmlspecialchars($_POST['id_photo']);
    
    // Vérifie s'il n'y a pas d'erreur lors du téléchargement
    if ($fileError === 0) {
        // Déplace le fichier téléchargé vers le dossier de destination
        $chemin = "../../public/Images/$fileName";
    
        // Vérifie si le déplacement du fichier s'est bien passé
        if (move_uploaded_file($fileTmpName, $chemin)) {
            // enregistrement des données en base de données
            $nouvCouvMaxInsert = $pdo->prepare('UPDATE `photos` SET `plat` = ?, `chemin` = ? WHERE `id` = ?');
            $nouvCouvMaxInsert->execute([$titrePhoto, $chemin, $idPhotoRemplace]);
    
            $_SESSION['message_photo'] = "Le remplacement de l'image n°$idPhotoRemplace a été effectué avec succès.";
            session_write_close();
            header('Location: ../../front/utilisateurs/pageAdminHtml.php');
        } else {
            //erreur de déplacement du fichier
            $_SESSION['message_photo'] = "Le remplacement de votre image a échoué.";
            session_write_close();
            header('Location: ../../front/utilisateurs/pageAdminHtml.php');
        }
    } else {
        //erreur de téléchargment du fichier
        $_SESSION['message_photo'] = "Le téléchargement de votre image a échoué.";
        session_write_close();
        header('Location: ../../front/utilisateurs/pageAdminHtml.php');
    }
    
} else {
    //erreur de téléchargment du fichier
    $_SESSION['message_photo'] = "Le téléchargement de votre image a échoué.";
    session_write_close();
    header('Location: ../../front/utilisateurs/pageAdminHtml.php');
}

//traitement du formulaire admin changeant les horaires
if  (isset($_POST['dej_ouverture'], $_POST['dej_fermeture'], $_POST['din_ouverture'], $_POST['din_fermeture'])) {
    $dejOuv = htmlspecialchars($_POST['dej_ouverture']);
    $dejFerm = htmlspecialchars($_POST['dej_fermeture']);
    $dinOuv = htmlspecialchars($_POST['din_ouverture']);
    $dinFerm = htmlspecialchars($_POST['din_fermeture']);

    $nouvHorairesInsert = $pdo->prepare('UPDATE `horaires` SET `dej_ouverture` = ?, `dej_fermeture` = ?, `din_ouverture` = ?, `din_fermeture` = ?');
    $nouvHorairesInsert->execute([$dejOuv, $dejFerm, $dinOuv, $dinFerm]);

    $_SESSION['message_horaires'] = 'La mise à jour des horaires a été effectuée avec succès.';
    session_write_close();
    header('Location: ../../front/utilisateurs/pageAdminHtml.php');
} else {
    //erreur de téléchargment du fichier
    $_SESSION['message_horaires'] = "La mise à jour des horaires a échoué.";
    session_write_close();
    header('Location: ../../front/utilisateurs/pageAdminHtml.php');
}
