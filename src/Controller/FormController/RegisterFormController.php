<?php

namespace App\Controller\FormController;

use App\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

## Controller formulaire d'inscription ##
class RegisterFormController extends AbstractController
{
    #[Route('/connexion?form=register', name: 'app_register_form', methods: ['GET', 'POST'])]
    
    public function RegisterForm(Request $request): Response
    {   
        $Register_form = $this->createForm(RegisterType::class);
        $Register_form->handleRequest($request);

         return $this->render('connexion.html.twig', [
            'Register_form' => $Register_form,
        ]);
       
    }
}