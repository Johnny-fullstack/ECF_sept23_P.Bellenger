<?php

namespace App\Controller\FormController;

use App\Entity\Reservations;
use App\Form\ReservationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

## Controller formulaire de réservationl##
class ResaFormController extends AbstractController
{
    #[Route('/reservation_form', name: 'app_resa_form', methods: ['GET', 'POST'])]
    
    public function resaForm(Request $request, EntityManagerInterface $em): Response 
    {
        $resa = new Reservations();
        $form_resa = $this->createForm(ReservationType::class);
        $form_resa ->handleRequest($request);

        if ($form_resa->isSubmitted() && $form_resa->isValid) {
            $em->persist($resa);
            $em->flush();
            return $this->redirectToRoute('index/Front/index.html.twig');
            }

        return $this->render('index/Front/resa.html.twig', [
            'form_resa' => $form_resa,
        ]);
    }
}