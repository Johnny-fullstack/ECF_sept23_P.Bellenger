<?php
include "../../src/pdo.php";
include "../../src/liens_nav.php";
include "../../src/verifCo.php";
include "../../src/entities/User.php";
include "../../src/entities/Reservation.php";
include "../../src/formulaires/NbPersTransformer.php";
include "../../src/adminFunc/dataRecup.php";

if (session_status() == PHP_SESSION_NONE) {
    // Si la session n'est pas déjà démarrée, on la démarre
    session_start();
}

if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];

    //récupération des infos utilisateurs
    $userId = $user->getId();
    $genre = $user->getGenre();
    $nom = $user->getNom();
    $prenom = $user->getPrenom();
    $email = $user->getEmail();
    $nbPers = $user->getDef_Nbpers();
    $allergies = $user->getAllergies();

    $varDefPers =  NbPersTransformer::transform($nbPers);

    $userReservations = array();

    // Récupération id des réservations associées à l'utilisateur
    $resaIdUser = $pdo->prepare('SELECT `id_resa` FROM `user_reservations` WHERE `id_user` = :id');
    $resaIdUser->bindvalue(':id', $userId); 
    $resaIdUser->execute();
    
    // Parcourir les IDs et récupérer les détails des réservations
    while ($row = $resaIdUser->fetch(PDO::FETCH_ASSOC)) {
        $resaId = $row['id_resa'];
        $reservation = $pdo->prepare('SELECT * FROM `reservations` WHERE `id` = :id');
        $reservation->bindvalue(':id', $resaId);
        $reservation->execute();
        $userReservations[] = $reservation->fetch(PDO::FETCH_ASSOC);
    }
    
    // Maintenant, $userReservations contient les détails des réservations de l'utilisateur

} elseif (isset($_SESSION['admin'])) {
    session_write_close();
    header('Location: ../admin_pageHtml.php');
    exit();
} else {
    // Redirigez si l'utilisateur n'est pas connecté
    session_write_close();
    header('Location: connexionHtml.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title>Page utilisateur - Quai Antique</title>
        <meta name="description" content="Page de compte des utilisateurs."/>
        <link rel="stylesheet" type="text/css" href="../../public/css/header&footer.css">
        <link rel="stylesheet" type="text/css" href="../../public/css/profil.css">
    </head>

    <body>
        <header>
            <div class="head">
                <h1 class="logo">Quai<br/> Antique</h1>

                <h2>Réserver une table</h2>

                <div class="infos">

                    <p class="contact_header">
                        7 Bd Gambetta, <br/>
                        73000, <br/>
                        Chambéry
                    </p>

                    <p class="contact_header">
                        01.50.64.85.45
                    </p>

                </div>

                <div class="div_inscri_co">
                   <?php verifCo()?>
                </div>
            </div>

            <nav>
                <a class="txtnavleft" href="<?php echo $lienAccueil?>">Accueil</a>
                <div class="bar_separation"></div>
                <a href="<?php echo $lienCarte?>">Notre Carte</a>
                <div class="bar_separation"></div>
                <a href="<?php echo $lienResa?>">Réservation</a>
            </nav>    
        </header>

        <main class="main">

        <div class="espace_user">
                <div class="espace_info">
                    <h3>Mes informations</h3>

                    <ul>
                        <li><?php echo "$genre $nom $prenom" ?></li>
                        <li>adresse email: <?php echo "$email" ?></li>
                        <li>Nombres de couverts par défaut: <?php echo "$varDefPers" ?></li>
                        <?php
                        if($allergies !== NULL) {
                            echo "<li>Allergie(s): $allergies </li>";
                        } else {
                            echo "<p>Aucune(s) allergie(s) n'a été déclérée(s)</p>";
                        }
                        ?>
                    </ul>
                </div>

                <div class="separation"></div>

                <div class="espace_reservation">
                    <h3>Mes réservations</h3>

                    <?php
                    if($userReservations == NULL) {
                        echo "<p>Aucune réservation n'a été enregistrée</p>"; 
                    } else {
                        echo "<table>";
                        echo "<tr>";
                        echo "<th>Nom</th>";
                        echo "<th>Pers.</th>";
                        echo "<th>Jour</th>";
                        echo "<th>Heure</th>";
                        echo "<th>Allergies</th>";
                        echo "</tr>";
                        foreach ($userReservations as $resaData) {
                            if ($resaData['heure_diner'] == NULL) {
                                $heures = $resaData['heure_dej']; 
                            } else {
                                $heures = $resaData['heure_diner']; 
                            }
                            echo "<tr>";
                            echo "<td>{$resaData['nom']}</td>";
                            echo "<td>{$resaData['nbpers']}</td>";
                            echo "<td>{$resaData['jour']}</td>";
                            echo "<td>{$heures}</td>";
                            echo "<td>{$resaData['allergies']}</td>";
                            echo "<td>";
                            echo "<form method='POST' action='../../src/formulaires/resaDel.php'>"; 
                            echo "<input type='hidden' name='resa_id' value='{$resaData['id']}'>";
                            echo "<button type='submit'>Supprimer</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }     
                        echo "</table>";                  
                    }
                    ?>
                </div>

                <div class="separation"></div>

                <div class="espace_de">
                    <form action="../../src/formulaires/deconnexion.php" method="post">
                        <button class="lil_but" type="submit">Déconnexion</button>
                    </form>
                </div>
            </div>

        </main>
        
        <footer>
            <div class="footer right">                
                <div class="title_footer">
                    <h3>Contact</h3>
                </div>
                
                <div class="para_footer">
                    <p>
                        Tél: 01.50.64.85.45 <br/>
                        mail: quai.antique@mail.fr
                    </p>
                </div>
            </div>  

            <div class="footer mid">                
                <div class="title_footer">
                    <h3>Horaires</h3>
                </div>
                
                <div class="para_footer">
                    <p>
                        Ouvert du mardi au samedi <br/>
                        Au déjeuner : <?php echo "$dejOuv à $dejFerm"?><br/>
                        Au dîner : <?php echo "$dinOuv à $dinFerm"?>
                    </p>
                </div>
            </div>

            <div class="footer left">                
                <div class="title_footer">
                    <h3>Pages Légales</h3>
                </div>
                
                <div class="para_footer">
                    <ul>
                        <li><a href="<?php echo $lienMention;?>">Mentions Légales</a></li>
                        <li><a href="<?php echo $lienConfident;?>">Politique de confidentialité </a></li>
                        <li><a href="<?php echo $lienCookie;?>">Politique d'utilisation des cookies</a></li>
                    </ul>
                </div>
            </div>              
        </footer>
    </body>
</html>