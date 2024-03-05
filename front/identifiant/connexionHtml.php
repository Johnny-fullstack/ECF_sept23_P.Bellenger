<?php
include "../../src/pdo.php";
include "../../src/liens_nav.php";
include "../../src/adminFunc/dataRecup.php";

if (session_status() == PHP_SESSION_NONE) {
    // Si la session n'est pas déjà démarrée, on la démarre
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>

        <meta charset="utf-8"/>
        <title>Connexion</title>
        <meta name="description" content="Page de connexion à votre espace client."/>
        <link rel="stylesheet" type="text/css" href="../../public/css/header&footer.css">
        <link rel="stylesheet" type="text/css" href="../../public/css/connexion.css">
    </head>

    <body>

        <nav>
            <a class="txtnavleft" href="<?php echo $lienAccueil?>">Revenir à la page d'Accueil</a>
        </nav>

        <main class="main">

                <form method="post" action="../../src/formulaires/connexion.php">
                    <h2>Connexion</h2>

                        <diV class="email">
                            <label for="mail">Adresse email :</label>
                            <input type="email" id="mail" name="mail" placeholder="..." required>
                        </div>

                        <div class="password">
                            <label for="password">Mot de passe :</label>
                            <input type="password" id="password" name="password" placeholder="..." required>
                        </div>

                        <div class="login_button">
                            <button type="submit">Connexion</button>
                            <a href="<?php echo $lienInscription?>">Je ne suis pas inscris</a>
                        </div>                   
                       
                        <p class="smserror">
                        <?php
                        // Vérification de l'existence du message dans la session
                        if (isset($_SESSION['message_error'])) {
                            // Stocker le message dans une variable temporaire
                            $messageError = $_SESSION['message_error'];                                    
                            // Afficher le message
                            echo $messageError;
                            // Supprimer le message
                            unset($_SESSION['message_error']);
                        }
                        ?>
                    </p> 
                </form>

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