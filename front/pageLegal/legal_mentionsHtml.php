<?php
include "../../src/liens_nav.php";
include "../../src/verifCo.php";
include "../../src/adminFunc/dataRecup.php";
?>
<!DOCTYPE html>
<html lang="fr">
    <head>

        <meta charset="utf-8"/>
        <title>Mentions Legales</title>
        <meta name="description" content="Page des mentions légales concernant l'hebergeur du site Quai Antique."/>
        <link rel="stylesheet" type="text/css" href="../../public/css/header&footer.css">

    </head>

    <body>
        
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
                <h2>Mentions Légales</h2>

                <div class="blackdiv">
                    <h2>Herbergeur web</h2>

                    <h3>Informations sur l'hébergeur :</h3>               
                    <ul>
                        <li>Nom complet de l'hébergeur: OVHcloud SAS</li>
                        <li>Raison sociale: OVHcloud</li>
                        <li>Adresse: 2 rue Kellermann - 59100 Roubaix - France</li>
                        <li>Numéro de téléphone: +33 9 72 10 10 07</li>
                    </ul>

                    <h3>Informations relatives à l'hébergement :</h3>
                    <ul>                             
                        <li>Nom du responsable technique: Octave Klaba</li>
                        <li>Adresse du responsable technique: 2 rue Kellermann - 59100 Roubaix - France</li>
                    </ul>

                    <h3>Liens utiles :</h3>
                    <ul>
                        <li><a href="//us.ovhcloud.com/legal/terms-of-service/">Lien vers les mentions légales d'OVHcloud</a></li>
                        <li><a href="https://www.ovhcloud.com/fr/terms-and-conditions/contracts/"> vers les conditions générales d'utilisation d'OVHcloud</a></li> 
                    </ul>
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