<?php
include "liens_nav.php";

function verifCo() {
    if (session_status() == PHP_SESSION_NONE) {
        // Si la session n'est pas déjà démarrée, on la démarre
        session_start();
    }
    if (isset($_SESSION['user'])) {
        session_write_close();
        echo '<a class="inscri_co" href="/front/utilisateurs/compteHtml.php">Mon espace</a>';
    } else if(isset($_SESSION['admin'])) {
        session_write_close();
        echo '<a class="inscri_co" href="/front/utilisateurs/pageAdminHtml.php">Mon espace</a>';
    } else {
        session_write_close();
        echo '<a class="inscri_co" href="/front/identifiant/inscriptionHtml.php">S\'inscrire</a>';
        echo '<a class="inscri_co" href="/front/identifiant/connexionHtml.php">Se connecter</a>';
    }
}
