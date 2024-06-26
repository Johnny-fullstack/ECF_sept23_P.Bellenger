<?php
include "../src/pdo.php";
include "../src/liens_nav.php";
include "../src/verifCo.php";
include "../src/adminFunc/dataRecup.php";
?>
<!DOCTYPE html>
<html lang="fr">
    <head>

        <meta charset="utf-8"/>
        <title>Notre carte - Quai Antique</title>
        <meta name="description" content="Page de la carte du restaurant, présentant les entrées, les plats, les desserts, ainsi que les formages, les boissons et nos menus."/>
        <link rel="stylesheet" type="text/css" href="../public/css/header&footer.css">
        <link rel="stylesheet" type="text/css" href="../public/css/carte.css">

    </head>

    <body>
        
        <header>

            <div class="head">
                <h1 class="logo">Quai<br/> Antique</h1>

                <h2>Notre Carte</h2>
                
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

                <div class="carte">

                    <div class="entrées">
                        
                        <h3>Entrées</h3>

                        <div class="grid_4_2">

                                <p>
                                    Croquette savoyardes à la muscade</br>
                                    <em>Boule de beaufort frit</em>
                                </p>

                                <p class="grid_prix">11€</p>
                            
                                <p>
                                    Buratta crémeuse</br>
                                    <em>Rouleaux de courgette à la buratta</em>
                                </p>

                                <p class="grid_prix">10€</p>

                                <p>
                                    Oeuf parfait et sa crème du jour</br>
                                    <em>Oeuf parfait basse température à la crème de parmesan et cèpes</em>
                                </p>

                                <p class="grid_prix">9€</p>

                                <p>
                                    Assiette à partager</br>
                                    <em>assiette d'amuse bouche avec les produits de la saison</em>
                                </p>
                                                            
                                <p class="grid_prix">25€</p>
                        </div>
                    </div>

                    <div class="boissons">
                        
                        <h3>Boissons</h3>

                        <div class="grid_boissons">
                     
                            <h4>Apéritifs</h4>

                            <h4>Vins</h4>

                            <div class="grid_apéritifs">

                                    <p>Martini</p>
                                    <p class="grid_prix">5.80€</p>

                                    <p>Ricard</p>
                                    <p class="grid_prix">4.50€</p>

                            </div>                                      
                            
                            <div class="bois_grid_3_2">
                                
                                    <p>Kir</p>
                                    <p class="prix">6.20€</p>

                                    <p> Vins rouge</p>
                                    <p class="prix">6.30€</p>

                                    <p> Vin blanc</p>    
                                    <p class="prix">6.40€</p>
                                
                            </div>
                        
                            <h4>Bières</h4>

                            <h4>Soda</h4>
                                
                            <div class="bois_grid_3_2">

                                    <p class="">Leffe</p>
                                    <p class="prix">6.60€</p>

                                    <p>Mont-blanc</p>
                                    <p class="prix">6.60€</p>

                                    <p>Picon bière</p>
                                    <p class="prix">6.30€</p>

                            </div>
                        
                            <div class="bois_grid_3_2">
                                
                                    <p>Coca</p>
                                    <p class="prix">5.20€</p>

                                    <p>Fanta</p>
                                    <p class="prix">4.80€</p>

                                    <p>Ice-tea</p>
                                    <p class="prix">4.80€</p>
                                
                            </div>
                        </div>

                        <div class="imgboissons"></div>
            
                    </div>

                    <div class="plats">
                        <h3>Plats</h3>

                        <div class="grid_plats_desserts">
                                <p>
                                    Fondu savoyarde (2pers)</br>
                                    <em>FOndu traditionnel au Comté, Beaufort et Emmental</em>
                                </p>

                                <p class="grid_prix">20€</p>

                                <p>
                                    Soupe parmentier</br>
                                    <em>Soupe aux légumes de saison et au parmentier de canard hachis</em>
                                </p>

                                <p class="grid_prix">13.50€</p>

                                <p>
                                    Croustillant Reblochon du Val d’Arly</br>
                                    <em>méli-mélo d’endives jeunes pousses au chutney d’oignons, dattes Majhoul et
                                        sa pointe de vinaigre miel balsamique</em>
                                </p>

                                <p class="grid_prix">27.80€</p>

                                <p>
                                    Risotto crémeux aux légumes du marché</br>
                                    <em>Risotto aux champignon et sa ratatouille de légumes</em>
                                </p>

                                <p class="grid_prix">24.20€</p>

                                <p>
                                    Tartiflette au reblochon</br>
                                    <em>Tartiflette traditionnel accompagné de sa salade façon savoyarde</em>
                                </p>

                                <p class="grid_prix">22.50€</p>
                            
                        </div>

                    </div>

                    <div class="menus">
                        <h3>Menus</h3>

                        <div class="grid_3_2">
                                <p>
                                    Menu du Jour</br>
                                    <em>entrée+plat du jour+dessert ou fromage</em>
                                </p>

                                <p class="grid_prix">29.90€</p>

                                <p>
                                    Menu Raclette 1 à 6 pers</li></br>
                                    <em>charcuterie+raclette+salade+dessert</em>
                                </p>

                                <p class="grid_prix">20€/pers</p>

                                <p>
                                    Menu enfant</br>
                                    <em>entrée+plat+dessert</em> 
                                </p>
                                
                                <p class="grid_prix">15€</p>
                        </div>
                    </div>
                    <div class="fromages">
                        <h3>Fromages</h3>

                        <div class="grid_3_2">
                
                                <p>Tomme de Savoie</p>
                                <p class="grid_prix">5€</p>

                                <p>Emmental de Savoie</p>
                                <p class="grid_prix">4€</p>

                                <p>Camembert</p>               
                                <p class="grid_prix">4.50€</p>
                        </div>      
                    </div>

                    <div class="dessert">
                        <h3>Desserts</h3>

                        <div class="grid_plats_desserts">

                                <p>Crème brûlée </p>
                                <p class="grid_prix">8.60€</p>

                                <p>Fondant au chocolat</p>
                                <p class="grid_prix">8.60€</p>

                                <p>Crumble aux pommes</p>
                                <p class="grid_prix">8.60€</p>

                                <p>
                                    Glace<br/>
                                    <em>Vanille, chocolat, fruits...</em>
                                </p>
                                <p class="grid_prix">1.80€/boule</p>
                        
                        </div>      
                    </div>

                    <div class="boissons_chaudes">
                        <h3>Boissons chaudes</h3>

                        <div class="grid_3_2">

                                <p>Café</p>
                                <p class="grid_prix">3€</p>

                                <p>Thé</p>
                                <p class="grid_prix">3€</p>

                                <p>Chocolat chaud</p>                                                          
                                <p class="grid_prix">3€</p>

                        </div>
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