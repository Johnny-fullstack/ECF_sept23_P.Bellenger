<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('email', EmailType::class, [
            'label' => 'Adresse email :',
            'required' => true,
            'attr' => [
                'placeholder' => '...',
                'class' => 'email'
            ],
        ])

        ->add('password', PasswordType::class, [
            'label' => 'Mot de passe :',
            'required' => true,
            'attr' => [
                'placeholder' => '...',
                'class' => 'password'
            ],
        ])
        
        ->add('submit', SubmitType::class, [
            'label' => "Connexion",
            'attr' => ['class' => 'login_button'],
        ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
  
    }
}