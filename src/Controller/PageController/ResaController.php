<?php

namespace App\Controller\PageController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

## Controller page de réservationl##
class ResaController extends AbstractController
{
    #[Route('/reservation', name: 'app_resa')]
    
    public function resa(): Response
    {
        return $this->render('index/Front/resa.html.twig', [
            'controller_name' => 'ResaController',
        ]);
    }
}