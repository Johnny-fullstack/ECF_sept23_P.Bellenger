<?php
if (session_status() == PHP_SESSION_NONE) {
    // Si la session n'est pas déjà démarrée, on la démarre
    session_start();
}

$pdo = new PDO('mysql:host=localhost;dbname=db_quaiantique', 'root', '');

//traitement du formulaire admin changeant le nombre de couvert maximum
if  (isset($_POST['couv_max'])) {
    $nouvCouvertsTotal = $_POST['couv_max'];

    $nouvCouvMaxInsert = $pdo->prepare('UPDATE `couverts` SET `couverts_total` = ? WHERE `id` = 1');
    $nouvCouvMaxInsert->execute([$nouvCouvertsTotal]);


    $_SESSION['message_couvert'] = 'La mise à jour des couverts maximum a été effectuée avec succès.';
    session_write_close();
    header('Location: ../../front/utilisateurs/pageAdminHtml.php');   
}

//traitement du formulaire admin changeant les photos
if (isset($_FILES['photo'])) {
    $file = $_FILES['photo'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileError = $file['error'];

    $titrePhoto = $_POST['plat'];
    $idPhotoRemplace = $_POST['id_photo'];
    
    // Vérifier s'il n'y a pas d'erreur lors du téléchargement
    if ($fileError === 0) {
        // Déplacer le fichier téléchargé vers le dossier de destination
        $chemin = "/public/images/$fileName";
    
        // Vérifier si le déplacement du fichier s'est bien passé
        if (move_uploaded_file($fileTmpName, $chemin)) {
            // Maintenant vous pouvez enregistrer le chemin du fichier dans votre base de données
            $nouvCouvMaxInsert = $pdo->prepare('UPDATE `photos` SET `plat` = ?, `chemin` = ? WHERE `id` = ?');
            $nouvCouvMaxInsert->execute([$titrePhoto, $chemin, $idPhotoRemplace]);
    
            $_SESSION['message_photo'] = "Le remplacement de l'image n°$idPhotoRemplace a été effectué avec succès.";
            session_write_close();
            header('Location: ../../front/utilisateurs/pageAdminHtml.php');
        } else {
            // Gérer les erreurs de déplacement du fichier
            echo "Une erreur s'est produite lors du déplacement du fichier.";
        }
    } else {
        // Gérer les erreurs de téléchargement
        echo "Une erreur s'est produite lors du téléchargement du fichier.";
        echo $fileError;
    }
    
}

//traitement du formulaire admin changeant les horaires
if  (isset($_POST[''])) {

    }