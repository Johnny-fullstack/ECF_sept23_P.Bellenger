<?php
include "../src/liens_nav.php";
include "../src/verifCo.php";
include "../src/adminFunc/dataRecup.php";

$pdo = new PDO('mysql:host=localhost;dbname=db_quaiantique', 'root', '');

//récupération des infos photos
$photoStatement = $pdo->prepare('SELECT * FROM `photos`');
$photoStatement->execute();

$tablePhotos = [];
if($photoStatement->rowCount() == 6) {
    $tablePhotos = $photoStatement->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>

        <meta charset="utf-8"/>
        <title>Quai Antique-Accueil</title>
        <link rel="stylesheet" type="text/css" href="../public/css/header&footer.css">
        <link rel="stylesheet" type="text/css" href="../public/css/accueil.css">

        <style>
            .img1 {
            background-image: url(<?php echo $tablePhotos[0]['chemin'] ?>);
            }
            .img2 {
            background-image: url(<?php echo $tablePhotos[1]['chemin'] ?>);
            }
            .img3 {
            background-image: url(<?php echo $tablePhotos[2]['chemin'] ?>);
            }
            .img4 {
            background-image: url(<?php echo $tablePhotos[3]['chemin'] ?>);
            }
            .img5 {
            background-image: url(<?php echo $tablePhotos[4]['chemin'] ?>);
            }
            .img6 {
            background-image: url(<?php echo $tablePhotos[5]['chemin'] ?>);
            }
        </style>

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

                <h2>Venez Découvrir ce que les produits de la région ont à offrir</h2>
    
                <div class="galerie">
                
                    <div class="img1">
                    
                        <span class="leg1"><?php echo $tablePhotos[0]['plat']?></span>
                    </div>
                    <div class="img2">
                    
                        <span class="leg2"><?php echo $tablePhotos[1]['plat']?></span>
                    </div>
                    <div class="img3">
                    
                        <span class="leg3"><?php echo $tablePhotos[2]['plat']?></span>
                    </div>
                    <div class="img4">
                    
                        <span class="leg4"><?php echo $tablePhotos[3]['plat']?></span>
                    </div>
                    <div class="img5">
                    
                        <span class="leg5"><?php echo $tablePhotos[4]['plat']?></span>
                    </div>
                    <div class="img6">
                    
                        <span class="leg6"><?php echo $tablePhotos[5]['plat']?></span>
                    </div>
                   
                </div>

                <a class="button_resa_accueil" href="<?php echo $lienResa;?>">Réserver une table</br> dès maintenant</a>

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