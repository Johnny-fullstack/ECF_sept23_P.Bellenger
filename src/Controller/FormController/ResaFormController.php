<?php

namespace App\Controller\FormController;

use App\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

## Controller formulaire de réservationl##
class ResaFormController extends AbstractController
{
    #[Route('/reservation/resa', name: 'app_resa_form', methods: ['GET', 'POST'])]
    
    public function resaForm(Request $request): Response 
    {
        $form_resa = $this->createForm(ReservationtType::class);
        $form_resa ->handleRequest($request);

        return $this->render('resa.html.twig', [
            'form_resa' => $form_resa,
        ]);
    }
}