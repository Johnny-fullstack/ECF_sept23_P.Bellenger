<?php
include '../entities/User.php';
include 'NbPersTransformer.php';

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=db_quaiantique', 'root', '');

// Récupération des données du formulaire
$genre = $_POST['genre'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$mail = $_POST['mail'];
$password = $_POST['password'];
$defPers = $_POST['def_nbpers'];
$allergies = $_POST['allergies'];


// Hashage du mot de passe
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Conversion defPers en int
$intDefPers =  NbPersTransformer::reverseTransform($defPers);

// Insertion des données en base de données
$insertUser = 'INSERT INTO `user` (`genre`, `nom`, `prenom`, `email`, `password`, `def_nbpers`, `allergies`) VALUES (?, ?, ?, ?, ?, ?, ?)';
$statement = $pdo->prepare($insertUser);
$statement->execute([$genre, $nom, $prenom, $mail, $hashed_password, $intDefPers, $allergies]);

if ($statement->rowCount() == 1) {
    // La requête a réussi
    echo 'Formulaire enregistré avec succès';

    $user_id = $pdo->lastInsertId();
    $role_id = 1; // l'ID du rôle 'user' dans la table 'roles'

    // Insérer l'association dans la table user_roles
    $pdo->exec("INSERT INTO `user_role` (`user_id`, `role_id`) VALUES ($user_id, $role_id)");
    
    session_start();
    $roleStatement = $pdo->prepare('SELECT * FROM `user_role` JOIN `roles` ON `roles`.`id` = `user_role`.`role_id` WHERE `user_id` = :id');
    $roleStatement->bindValue(':id', $user_id);

    if ($roleStatement->execute()) {
        $roles = array();

        while ($role = $roleStatement->fetch(PDO::FETCH_ASSOC)) {
            $_SESSION['user_role'][] = $role['nom'];  
            $roles[] = $role['nom'];   
        }
    
        // Création objet contenant les infos user
        $user = new User($user_id, $genre, $nom, $prenom, $mail, $password, $intDefPers, $allergies, $roles);
        // Stocker l'objet User en session
        $_SESSION['user'] = $user;
    }

    session_write_close();

    header('Location: ../../front/utilisateurs/compteHtml.php');
} else {
    // La requête a échoué
    $errorInfo = $statement->errorInfo();
    error_log('SQLSTATE : ' . $errorInfo[0] . PHP_EOL .
    'Erreur du driver : ' . $errorInfo[1] . PHP_EOL .
    'Message : ' . $errorInfo[2]);
};