<?php
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
        <title>Inscription</title>
        <link rel="stylesheet" type="text/css" href="../../public/css/header&footer.css">
        <link rel="stylesheet" type="text/css" href="../../public/css/connexion.css">
    </head>

    <body>

        <nav>
            <a class="txtnavleft" href="<?php echo $lienAccueil?>">Revenir à la page d'Accueil</a>
        </nav>

        <main>

            <form method="post" action="../../src/formulaires/inscription.php">
                <h2>Inscription</h2>
                
                    <div class="genre">
                        <p>Vous êtes un(e):</p>
                        <div>
                            <div class="radio">
                                <input type="radio" id="Mr" name="genre" value="Mr">
                                <label for="Mr">Homme</label>
                            </div>
                            <div class="radio">
                                <input type="radio" id="Mme" name="genre" value="Mme">
                                <label for="Mme">Femme</label>
                            </div>
                        </div>
                    </div>
                    

                    <div class="identité">
                        <label for="prenom">Prénom:</label>
                        <input type="text" name="prenom" id="prenom" placeholder="..." required>
                        </br>
                        <label for="nom">Nom :</label>
                        <input type="text" name="nom" id="nom" placeholder="..." required>
                    </div>

                    <diV class="email">
                        <label for="mail">Adresse email :</label>
                        <input type="email" id="mail" name="mail" placeholder="..." required>
                    </div>

                    <div class="password">
                        <label for="password">Mot de passe :</label>
                        <input type="password" id="password" name="password" placeholder="..." required>
                    </div>

                    <div class="defaut_nbpers">
                        <p>Par défaut, lorsque vous réserver une table sur le site, pour combien de personne la voulez-vous ?</p>
                            <div>
                                <div class="radio">
                                    <input type="radio" id="1pers" name="def_nbpers" value="1pers">
                                    <label for="1pers">1 pers.</label>
                                </div>

                                <div class="radio">
                                    <input type="radio" id="2pers" name="def_nbpers" value="2pers">
                                    <label for="2pers">2 pers.</label>
                                </div>
                                
                                <div class="radio">
                                    <input type="radio" id="3pers" name="def_nbpers" value="3pers">
                                    <label for="3pers">3 pers.</label>
                                </div>

                                <div class="radio">
                                    <input type="radio" id="4pers" name="def_nbpers" value="4pers">
                                    <label for="4pers">4 pers.</label>
                                </div>
                                
                                <div class="radio">
                                    <input type="radio" id="5pers" name="def_nbpers" value="5pers">
                                    <label for="5pers">5 pers.</label>
                                </div>
                                
                                <div class="radio">
                                    <input type="radio" id="6pers" name="def_nbpers" value="6pers">
                                    <label for="6pers">6 pers.</label>
                                </div>
                            </div>
                    </div>
                            
                    <div class="allergie">
                        <label for="message">Indiquez dans le champ ci-dessous s’il y a des allergies dont vous voulez nous faire part :</label>
                        <textarea rows="3" cols="40" name="allergies" id="allergies" placeholder="..."></textarea>
                    </div>
                                
                    <div class="login_button">
                        <button type="submit">Je m'inscris</button>
                        <div class="login_button">
                            <a href="<?php echo $lienConnexion?>">J'ai déjà un compte</a>           
                        </div>           
                    </div>

                    <p class="message">
                        <?php
                        // Vérification de l'existence du message dans la session
                        if (isset($_SESSION['message_error'])) {
                            // Stocker le message dans une variable temporaire
                            $messageCouvert = $_SESSION['message_error'];                                    
                            // Afficher le message
                            echo $messageCouvert;
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
    <script src="../../public/js/attachEvent.js"></script>
</html>