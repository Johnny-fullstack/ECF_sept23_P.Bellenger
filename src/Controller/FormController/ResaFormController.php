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
    

        if (isset($_SESSION['id'])) {
            $userData1 = $_SESSION['defaut_nbpers'];
            $userData2 = $_SESSION['allergies'];

            $form = $this->createForm(ReservationType::class, $resa, [
                'nbpers' => $userData1,
                'allergies' => $userData2,
            ]);

        } else {
            $form_resa = $this->createForm(ReservationType::class, $resa);
        }

        $form_resa ->handleRequest($request);

        if ($form_resa->isSubmitted() && $form_resa->isValid()) {
            $em->persist($resa);
            $em->flush();
            $this->addFlash('success', 'Réservation validé !');
            return $this->redirectToRoute('home');
            }
           
   

        return $this->render('index/front/resa.html.twig', [
            'form_resa' => $form_resa,
        ]);
    }
}