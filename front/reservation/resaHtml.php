<?php
include "../../src/pdo.php";
include "../../src/liens_nav.php";
include "../../src/verifCo.php";
include "../../src/entities/User.php";
include "../../src/formulaires/NbPersTransformer.php";
include "../../src/adminFunc/dataRecup.php";

if (session_status() == PHP_SESSION_NONE) {
    // Si la session n'est pas déjà démarrée, on la démarre
    session_start();
}

if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];

    //récupération des infos user nécessaires
    $nom = $user->getNom();
    $email = $user->getEmail();
    $nbPers = $user->getDef_Nbpers();
    $allergies = $user->getAllergies();

    $varDefPers =  NbPersTransformer::transform($nbPers);
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>

        <meta charset="utf-8"/>
        <title>Réservation - Quai Antique</title>
        <meta name="description" content="Page de réservation de notre restaurant Quai Antique, d'ici vous pouvez réserver une table pour le déjeuner ou le dîner."/>
        <link rel="stylesheet" type="text/css" href="../../public/css/header&footer.css">
        <link rel="stylesheet" type="text/css" href="../../public/css/resa.css">

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

            <form method="post" action="../../src/formulaires/reservation.php">
                    
                <h2>Réserver une table</h2>
                
                <div class="nom">
                    <label for="nom">Nom de la réservation :</label>
                    <input type="text" name="nom" id="nom" placeholder="..." value="<?php echo isset($nom) ? $nom : '';?>" required>
                </div>

                <diV class="email">
                    <label for="mail">Adresse email :</label>
                    <input type="email" id="mail" name="mail" placeholder="..." value="<?php echo isset($email) ? $email : '';?>" required>
                </div>
        
                <div class="nbpers">
                    <p>Réserver une table pour :</p>

                    <div class="radio">
                        <input type="radio" id="1pers" name="nbpers" value="1pers" <?php echo (isset($varDefPers) && $varDefPers === "1pers") ? "checked" : ""; ?>>
                        <label for="1pers">1 pers.</label>
                    </div>

                    <div class="radio">
                        <input type="radio" id="2pers" name="nbpers" value="2pers" <?php echo (isset($varDefPers) && $varDefPers === "2pers") ? "checked" : ""; ?>>
                        <label for="2pers">2 pers.</label>
                    </div>
                    
                    <div class="radio">
                        <input type="radio" id="3pers" name="nbpers" value="3pers" <?php echo (isset($varDefPers) && $varDefPers === "3pers") ? "checked" : ""; ?>>
                        <label for="3pers">3 pers.</label>
                    </div>

                    <div class="radio">
                        <input type="radio" id="4pers" name="nbpers" value="4pers" <?php echo (isset($varDefPers) && $varDefPers === "4pers") ? "checked" : ""; ?>>
                        <label for="4pers">4 pers.</label>
                    </div>
                    
                    <div class="radio">
                        <input type="radio" id="5pers" name="nbpers" value="5pers" <?php echo (isset($varDefPers) && $varDefPers === "5pers") ? "checked" : ""; ?>>
                        <label for="5pers">5 pers.</label>
                    </div>
                    
                    <div class="radio">
                        <input type="radio" id="6pers" name="nbpers" value="6pers" <?php echo (isset($varDefPers) && $varDefPers === "6pers") ? "checked" : ""; ?>>
                        <label for="6pers">6 pers.</label>
                    </div>
                        
                </div>

                <div class="date">
                    <label for="date_resa">A la date du :</label>
                    <input type="date" id="date_resa" name="jour" min="2023-05-01" max="2024-06-30">
                </div>

                <div class="horaire">
                    <p>Pour le déjeuner ou le dîner:</p>
                    
                    <div class="radio">
                        <input type="radio" id="dej" name="dej_din" value="dej">
                        <label for="dej">Déjeuner</label>
                    </div>

                    <div class="radio">
                        <input type="radio" id="diner" name="dej_din" value="diner">
                        <label for="diner">Dîner</label>
                    </div>
                    <div id="places_restantes"></div>
                    <div id="heures"></div>
                </div>

                <div class="allergies">
                    <label for="message">Indiquez dans le champ ci-dessous s’il y a des allergies dont vous voulez nous faire part :</label>
                    <textarea rows="3" cols="40" name="allergies" id="allergies"><?php echo isset($allergies) ? $allergies : "";?></textarea>

                    <button type="submit">Réserver</button>
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
    <script src="../../public/js/attachEvent.js" ></script>
    <script src="../../public/js/couvertAsync.js" ></script>
</html>