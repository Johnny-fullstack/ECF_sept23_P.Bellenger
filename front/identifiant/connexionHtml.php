<?php
include "../../src/liens_nav.php";
?>
<!DOCTYPE html>
<html lang="fr">
    <head>

        <meta charset="utf-8"/>
        <title>Connexion</title>
        <link rel="stylesheet" type="text/css" href="../../public/css/header&footer.css">
        <link rel="stylesheet" type="text/css" href="../../public/css/connexion.css">
    </head>

    <body>

        <nav>
            <a class="txtnavleft" href="<?php echo $lienAccueil?>">Revenir à la page d'Accueil</a>
        </nav>

        <main class="main_co">

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
                            <a href="<?php echo $lienInscription?>">Je ne suis pas inscris<a>
                        </div>                   
                       
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