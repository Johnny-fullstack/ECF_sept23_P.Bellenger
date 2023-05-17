<?php

namespace App\Controller\PageController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

## Controller page de la carte##
class CarteController extends AbstractController
{
    #[Route('/carte', name: 'app_carte')]
    
    public function carte(): Response
    {
        return $this->render('index/Front/carte.html.twig', [
            'controller_name' => 'CarteController',
        ]);
    }
}