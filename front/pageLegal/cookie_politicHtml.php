<?php
include "../../src/pdo.php";
include "../../src/liens_nav.php";
include "../../src/verifCo.php";
include "../../src/adminFunc/dataRecup.php";
?>
<!DOCTYPE html>
<html lang="fr">
    <head>

        <meta charset="utf-8"/>
        <title>cookies politic</title>
        <meta name="description" content="Page sur la politiques des cookies de Quai Antique."/>
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
                <h2>Politique d'utilisation des cookies</h2>

                <div class="blackdiv">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce nec ultricies lacus, eget vestibulum urna. Nullam sed posuere ipsum. Duis ut sapien sit amet est sollicitudin viverra. Quisque vestibulum neque nec felis placerat, sed commodo ex lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin vel lorem ut mauris efficitur sollicitudin. Mauris vitae eros eget nunc consectetur varius sed nec lacus. Nulla facilisi. Vestibulum consectetur ligula at feugiat.</p>
                    <p>Sed auctor, libero nec tincidunt tincidunt, nunc nunc tincidunt libero, nec tincidunt libero nunc nec libero.</p>
                    <p>Suspendisse vehicula, velit a volutpat pharetra, lorem magna fringilla risus, sed cursus urna mi sit amet lorem. Cras ultricies vel risus eu fermentum. Vestibulum sodales nunc eget dolor sodales lacinia. Sed vel urna sed ex ullamcorper tristique. Integer rutrum a libero et euismod. Curabitur at fermentum justo. Aenean sit amet dui sem. Nulla facilisi. Vivamus lacinia, nulla et dignissim consequat, nibh turpis dictum arcu, id efficitur ligula nisl eu dolor. Nulla vel aliquet elit.</p>
                    <p>dolor. Nulla facilisi. Vivamus lacinia, nulla et dignissim consequat, nibh turpis dictum arcu, id efficitur ligula nisl eu dolor. Nulla vel aliquet elit.</p>
                    <p>Morbi pharetra nibh id turpis efficitur, vel ultrices libero scelerisque. Integer consequat mi ac est fermentum varius. Fusce sit amet augue nec odio tincidunt auctor. Donec sit amet felis nec mi bibendum pharetra. Nam fermentum est vitae nunc varius, id malesuada purus cursus. Nullam congue eros sit amet luctus rutrum. Aliquam vitae velit id velit eleifend consequat. Curabitur in justo felis.</p>
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