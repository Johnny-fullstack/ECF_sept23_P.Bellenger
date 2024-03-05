<?php
include "../../src/pdo.php";
include '../entities/User.php';
include '../entities/Admin.php';

if (session_status() == PHP_SESSION_NONE) {
    // Si la session n'est pas déjà démarrée, on la démarre
    session_start();
}

$mail = htmlspecialchars($_POST['mail']);
$password = htmlspecialchars($_POST['password']);

$adminStatement = $pdo->prepare('SELECT * FROM `admin` WHERE `email` = :mail');
$userStatement = $pdo->prepare('SELECT * FROM `user` WHERE `email` = :mail');

//récupère l'admin, par rapport au mail
$adminStatement->bindValue(':mail', $mail);
// récupère utilisateur ayant le même mail
$userStatement->bindValue(':mail', $mail);

// Vérification que c'est un user qui se connecte
if ($userStatement->execute()) {
    $user = $userStatement->fetch(PDO::FETCH_ASSOC);
    // Si pas de $user correspondant, on vérifie si c'est un admin
    if ($user === false) {

        if ($adminStatement->execute()) {
            $admin = $adminStatement->fetch(PDO::FETCH_ASSOC); // Récupère l'admin ayant le même mail
            if ($admin === false) {
                //aucun mail correspondant
                $_SESSION['message_error'] = "L'adresse mail n'existe pas";
                session_write_close();
                header('Location: ../../front/identifiant/connexionHtml.php');
            } else { 
                if (md5($password) === $admin['password']) {// Si mail vérifié, vérifie le hash du password admin

                    session_start();
                    $roleStatement = $pdo->prepare('SELECT * FROM `admin_role` JOIN `roles` ON `roles`.`id` = `admin_role`.`role_id` WHERE `admin_id` = :id');
                    $roleStatement->bindValue(':id', $admin['id']);
        
                    if ($roleStatement->execute()) {
                        $roles = array();
        
                        while ($role = $roleStatement->fetch(PDO::FETCH_ASSOC)) {
                            $_SESSION['admin_role'][] = $role['nom'];  
                            $roles[] = $role['nom'];   
                        }
                  
                        $admin = new Admin($admin['id'],$admin['username'],$admin['email'], $admin['password'], $roles); // Création objet contenant les infos admin 
                        $_SESSION['admin'] = $admin; // Stocker l'objet Admin en session        
                    }
                    session_write_close();
                    header('Location: ../../front/utilisateurs/pageAdminHtml.php');
                } else {
                    // erreur mot de passe admin
                    $_SESSION['message_error'] = "Le mot de passe n'est pas correct.";
                    session_write_close();
                    header('Location: ../../front/identifiant/connexionHtml.php');
                }
            }
        } else {
                // erreur mail user
                $_SESSION['message_error'] = "L'adresse mail n'existe pas";
                session_write_close();
                header('Location: ../../front/identifiant/connexionHtml.php');
            }

    } else {
        // vérifie le hash du password user
        if (password_verify($password, $user['password'])) {

            session_start();
            $roleStatement = $pdo->prepare('SELECT * FROM `user_role` JOIN `roles` ON `roles`.`id` = `user_role`.`role_id` WHERE `user_id` = :id');
            $roleStatement->bindValue(':id', $user['id']);

            if ($roleStatement->execute()) {
                $roles = array();

                while ($role = $roleStatement->fetch(PDO::FETCH_ASSOC)) {
                    $_SESSION['user_role'][] = $role['nom'];  
                    $roles[] = $role['nom'];   
                }
               
                $user = new User($user['id'], $user['genre'], $user['nom'], $user['prenom'], $user['email'], $user['password'], $user['def_nbpers'], $user['allergies'], $roles);// Création objet contenant les infos user               
                $_SESSION['user'] = $user; // Stocker l'objet User en session   
            }
            session_write_close();
            header('Location: ../../front/utilisateurs/compteHtml.php');
        } else {
            // erreur mot de passe
            $_SESSION['message_error'] = "Le mot de passe n'est pas correct.";
            session_write_close();
            header('Location: ../../front/identifiant/connexionHtml.php');
        }
    }
} else {
    // erreur execution requête
    $_SESSION['message_error'] = "La connexion à échoué.";
    session_write_close();
    header('Location: ../../front/identifiant/connexionHtml.php');
}


