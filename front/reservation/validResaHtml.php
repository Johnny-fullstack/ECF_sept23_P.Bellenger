<?php
include "../../src/pdo.php";
include "../../src/liens_nav.php";
include "../../src/verifCo.php";
include "../../src/entities/Reservation.php";
include "../../src/entities/User.php";
include "../../src/adminFunc/dataRecup.php";

if (session_status() == PHP_SESSION_NONE) {
    // Si la session n'est pas déjà démarrée, on la démarre
    session_start();
}

// Récupérer la réservation depuis la session
if (isset($_SESSION['resa'])) {
    $resa = $_SESSION['resa'];

    $nom= $resa->getNom();
    $mail= $resa->getMail();
    $jour= $resa->getJour();
    $heureDej = $resa->getHeureDej();
    $heureDin = $resa->getHeureDin();

    if ($heureDej !== NULL && $heureDin == 0) {
        $heure = $heureDej;
    } else if ($heureDin !== NULL && $heureDej == 0) {
        $heure = $heureDin;
    }

    $smsValidation = "<p>Merci pour votre réservation !<br> Un mail vous à été envoyé à $mail.<br> Nous vous attendons le $jour à $heure au nom de $nom.<br> Pour toute annulation n'hésité pas à nous informé par mail ou par téléphone.</p>";
} else if(isset($_SESSION['userResa'])) {
    $resa = $_SESSION['userResa'];

    $nom= $resa->getNom();
    $mail= $resa->getMail();
    $jour= $resa->getJour();
    $heureDej = $resa->getHeureDej();
    $heureDin = $resa->getHeureDin();

    if ($heureDej !== NULL && $heureDin == 0) {
        $heure = $heurDej;
    } elseif ($heureDin !== NULL && $heureDej == 0) {
        $heure = $heureDin;
    }

    $smsValidation = "<p>Merci pour votre réservation !<br> Un mail vous à été envoyé à $mail.<br> Nous vous attendons le $jour à $heure au nom de $nom.<br> Vous pouvez consulter et gérer vos reservations depuis votre espace client.</p>";
} else {
    echo "COMMENT ËTES VOUS ARRIVE ICI ??";
}
session_write_close();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>

        <meta charset="utf-8"/>
        <title>Réservation validée</title>
        <meta name="description" content="Page de confirmation de réservation."/>
        <link rel="stylesheet" type="text/css" href="../../public/css/header&footer.css">

    </head>

    <body class="body">
        
            <header>

                <div class="head">
                    <h1 class="logo">Quai<br/> Antique</h1>

                    <h2>La cuisine savoyarde par </br> Le Chef Arnaud Michant</h2>
                    
                    <div class="infos">

                        <p class="contact_header">
                            7 Bd Gambetta, <br/>
                            73000, <br/>
                            Chambérye
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

            <main>

                <div class="blackdiv">
                    <?php echo $smsValidation; ?>
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