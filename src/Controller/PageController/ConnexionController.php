<?php

namespace App\Controller\PageController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

## Controller page de connexion##
class ConnexionController extends AbstractController
{
    #[Route('/connexion', name: 'app_connexion')]
    
    public function connexion(): Response
    {
        return $this->render('index/Front/connexion.html.twig', [
            'controller_name' => 'ConnexionController',
        ]);
    }
}