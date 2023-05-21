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

use PDO;
use function password_verify;

## Controller formulaire d'inscription ##
class ConnexionFormController extends AbstractController
{
    #[Route('/connexion_form', name: 'app_connexion_form', methods: ['GET', 'POST'])]
    
    public function connexionForm(Request $request, EntityManagerInterface $em): Response
    {   
        $user = new User();
        $Register_form = $this->createForm(RegisterType::class);
        $login_form = $this->createForm(LoginType::class);

        $Register_form->handleRequest($request);
        $login_form->handleRequest($request);

        if ($Register_form->isSubmitted() && $Register_form->isValid()) {
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('home');
            };

            if ($login_form->isSubmitted() && $login_form->isValid()) {
                // Connexion à la base de données
                $dsn = "mysql://root:@localhost:3306/db_QuaiAntique";
                $username = 'nom';
                $password = 'password';
                $pdo = new PDO($dsn, $username, $password);

                // Récupération des valeurs du formulaire
                $email = $_POST['email'];
                $password = $_POST['password'];

                // Requête pour vérifier les informations d'identification dans la base de données
                $query = "SELECT * FROM User WHERE email = :email";
                $stmt = $pdo->prepare($query);
                $stmt->execute(['email' => $email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                // Vérification du mot de passe
                if ($user && password_verify($password, $user['password'])) {
                    // Authentification réussie
                    header('Location: home');
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