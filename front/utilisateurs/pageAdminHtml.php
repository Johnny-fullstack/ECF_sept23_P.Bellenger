<?php
include "../../src/liens_nav.php";
include "../../src/verifCo.php";
include "../../src/entities/Admin.php";

include "../../src/adminFunc/dataRecup.php";

if (session_status() == PHP_SESSION_NONE) {
    // Si la session n'est pas déjà démarrée, on la démarre
    session_start();
}

if(!isset($_SESSION['admin'])) {
    header('Location: ../accueilHtml.php');
    exit();
} else if(isset($_SESSION['admin'])) {
    $adminInfo = $_SESSION['admin'];
    
}  
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title></title>
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

        <main>

        <div class="espace_admin">
                <div class="espace_modif couvert">
                    <div class="form">
                        <h3>Nombre maximum de couverts</h3>

                        <p>Nombre Total de couverts actuel : <?php echo $couvertsTotal ?></p>

                        <form action="../../src/adminFunc/adminForms.php" method="post">
                            <label for="nombre_couverts">Indiquez le nouveau nombre de couverts :</label>
                            <input type="number" id="nombre_couverts" name="couv_max" min="1" required>
                            <button type="submit">Modifier</button>
                        </form>
                    </div>
                    <p class="message">
                        <?php
                        // Vérification de l'existence du message dans la session
                        if (isset($_SESSION['message_couvert'])) {
                            // Stocker le message dans une variable temporaire
                            $messageCouvert = $_SESSION['message_couvert'];                                    
                            // Afficher le message
                            echo $messageCouvert;
                            // Supprimer le message
                            unset($_SESSION['message_couvert']);
                        }
                        ?>
                    </p> 
                </div>

                <div class="espace_modif photos">
                    <div class="form"> 
                        <h3>Photos en page d'accueil</h3>

                        <?php affichagePhoto($photoStatement);?>

                        <form action="../../src/adminFunc/adminForms.php" method="post" enctype="multipart/form-data">
                            <label for="plat">Nom du plat:</label>
                            <input type="text" id="plat" name="plat" required> 

                            <label for="photo">Glissez la photo à ajouter:</label>
                            <input type="file" accept="image/jpeg, image/png" id="photo" name="photo" accept="image/*" required>

                            <label for="id_photo">Numéro de la photo à remplacer:</label>
                            <input type="number" id="id_photo" name="id_photo" min="1" max="6" required>
                            <button type="submit">Modifier</button>
                        </form>
                    </div>

                    <p class="message">
                        <?php
                        // Vérification de l'existence du message dans la session
                        if (isset($_SESSION['message_photo'])) {
                            // Stocker le message dans une variable temporaire
                            $messagePhoto = $_SESSION['message_photo'];                            
                            // Supprimer le message de la session
                            unset($_SESSION['message_photo']);                       
                            // Afficher le message
                            echo $messagePhoto;
                        }
                        ?>
                    </p>
                </div>

                <div class="espace_modif horaires">
                    <div class="form">
                        <h3>Horaires</h3>
                        
                        <form action="../../src/adminFunc/adminForms.php" method="post">
                            <label for="dej_ouverture">ouverture dejeuner:</label>
                            <input type="text" id="dej_ouverture" name="dej_ouverture" required>

                            <label for="dej_fermeture">fermeture dejeuner:</label>
                            <input type="text" id="dej_fermeture" name="dej_fermeture" required> 

                            <label for="dej_ouverture">ouverture diner:</label>
                            <input type="text" id="din_ouverture" name="din_ouverture" required>

                            <label for="dej_fermeture">fermeture diner:</label>
                            <input type="text" id="din_fermeture" name="din_fermeture" required>
                            <button type="submit">Modifier</button>
                        </form>
                    </div>

                    <p class="message">
                        <?php
                        // Vérification de l'existence du message dans la session
                        if (isset($_SESSION['message_horaires'])) {
                            // Stocker le message dans une variable temporaire
                            $messageHoraires = $_SESSION['message_horaires'];                   
                            // Supprimer le message de la session
                            unset($_SESSION['message_horaires']);
                            // Afficher le message
                            echo $messageHoraires;
                        }
                        ?>
                    </p>
                </div>

                <div class="espace_de">
                    <form action="../../src/formulaires/deconnexion.php" method="post">
                        <button type="submit">Déconnexion</button>
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
                        Au déjeuner : 11h30 à 14h30 <br/>
                        Au dîner : 19h30 à 22h30
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