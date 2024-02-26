<?php
include '../entities/User.php';
include '../entities/Admin.php';

$mail = $_POST['mail'];
$password = $_POST['password'];

$pdo = new PDO('mysql:host=localhost;dbname=db_quaiantique', 'root', '');
$adminStatement = $pdo->prepare('SELECT * FROM `admin` WHERE `email` = :mail');
$userStatement = $pdo->prepare('SELECT * FROM `user` WHERE `email` = :mail');

//récupère l'admin
$adminStatement->bindValue(':mail', $mail);
// récupère utilisateur ayant le même login
$userStatement->bindValue(':mail', $mail);

if ($userStatement->execute()) {
    $user = $userStatement->fetch(PDO::FETCH_ASSOC);

    if ($user === false) {
        
        // Si pas de $user correspondant, vérification que c'est un admin qui se connecte
        if ($adminStatement->execute()) {
            $admin = $adminStatement->fetch(PDO::FETCH_ASSOC);
            if ($admin === false) {
                // erreur mail admin 
                echo "Les informations renseignées sont mauvaises";
            } else {
                // vérifie le hash du password admin
                if (md5($password) === $admin['password']) {
        
                    session_start();
                    $roleStatement = $pdo->prepare('SELECT * FROM `admin_role` JOIN `roles` ON `roles`.`id` = `admin_role`.`role_id` WHERE `admin_id` = :id');
                    $roleStatement->bindValue(':id', $admin['id']);
        
                    if ($roleStatement->execute()) {
                        $roles = array();
        
                        while ($role = $roleStatement->fetch(PDO::FETCH_ASSOC)) {
                            $_SESSION['admin_role'][] = $role['nom'];  
                            $roles[] = $role['nom'];   
                        }
        
                        // Création objet contenant les infos admin
                        $admin = new Admin($admin['id'],$admin['username'],$admin['email'], $admin['password'], $roles);
                        // Stocker l'objet Admin en session
                        $_SESSION['admin'] = $admin;         
                    }
                    session_write_close();
                    header('Location: ../../front/utilisateurs/pageAdminHtml.php');
                } else {
                    // erreur mot de passe admin ou user
                    echo 'Mot de passe invalide';
                }
            }
        } else {
                // erreur mail user
                echo 'Mail renseigné invalide';
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

                // Création objet contenant les infos user
                $user = new User($user['id'], $user['genre'], $user['nom'], $user['prenom'], $user['email'], $user['password'], $user['def_nbpers'], $user['allergies'], $roles);
                // Stocker l'objet User en session
                $_SESSION['user'] = $user;         
            }
            session_write_close();
            header('Location: ../../front/utilisateurs/compteHtml.php');
        } else {
            // erreur mot de passe
            echo 'Mot de passe invalide';
        }
    }
} else {
    echo 'Impossible de récupérer l\'utilisateur';
}


