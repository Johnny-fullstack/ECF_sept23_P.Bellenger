<?php

namespace App\Controller\FormController;

use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

## Controller formulaire de connexion ##
class LoginFormController extends AbstractController
{
    #[Route('/connexion/login', name: 'app_login_form', methods: ['GET', 'POST'])]
    
    public function loginForm(Request $request): Response
    {   
        $login_form = $this->createForm(LoginType::class);
        $login_form->handleRequest($request);

        return $this->render('connexion.html.twig', [
            'login_form' => $login_form,
        ]);
    }
}