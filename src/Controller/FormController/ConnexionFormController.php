<?php

namespace App\Controller\FormController;

use App\Entity\User;
use App\Entity\Admin;
use App\Form\RegisterType;
use App\Form\LoginType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

## Controller formulaire d'inscription ##
class ConnexionFormController extends AbstractController
{
    #[Route('/connexion_form', name: 'app_connexion_form', methods: ['GET', 'POST'])]
    
    public function connexionForm(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {   
        $user = new User();
        $Register_form = $this->createForm(RegisterType::class, $user);
        $login_form = $this->createForm(LoginType::class);

        $Register_form->handleRequest($request);
        $login_form->handleRequest($request);

        if ($Register_form->isSubmitted() && $Register_form->isValid()) {
            $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($hashedPassword);
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'Incription validé !');
            return $this->redirectToRoute('home');
            };

        if ($login_form->isSubmitted() && $login_form->isValid()) {
            $email = $login_form->get('email')->getData();
            $password = $login_form->get('password')->getData();
                       
            $userRepository = $em->getRepository(User::class) ;
            $user = $userRepository->findOneBy(['email' => $email]);

           # $user->setPassword($password);
            # echo "email = " . $email . "<br>";
            # echo "password = " . $password . "<br>" ;
            # echo "user->getPassword() = " . $user->getPassword() . "<br>" ; 
            // Vérification du mot de passe
            if ($user && $passwordHasher->isPasswordValid($user, $password)) {
                // Authentification réussie
                $this->addFlash('success', 'Connexion validé !');
                header('Location: https://ecfquaiantique.herokuapp.com/notre_carte');
                exit();
            } else {
                // Authentification échouée
                echo "Identifiants incorrects.";
            }
        };

         return $this->render('index/Front/connexion.html.twig', [
            'Register_form' => $Register_form,
            'Login_form' => $login_form,
        ]);
       
    }
}