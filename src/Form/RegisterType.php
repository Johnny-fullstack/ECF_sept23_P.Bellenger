<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\NbPersTransformer;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('genre', ChoiceType::class, [
            'label' => 'Vous êtes :',
            'required' => true,
            'expanded' => true,
            'choices' => [
                'un Homme' => 'Mr',
                'une Femme' => 'Mme',
            ],
            'choice_attr' => function() {
                return ['class' => 'radio'];
            },
            'attr' => ['class' => 'genre'],
        ])

        ->add('prenom', TextType::class, [
            'label' => 'Prénom :',
            'required' => true,
            'attr' => [
                'placeholder' => '...',
                'class' => 'identité'
        ],
        ])

        ->add('nom', TextType::class, [
            'label' => 'Nom :',
            'required' => true,
            'attr' => [
                'placeholder' => '...',
                'class' => 'identité',
            ],
        ])

        ->add('email', EmailType::class, [
            'label' => 'Adresse email :',
            'required' => true,
            'attr' => [
                'placeholder' => '...',
                'class' => 'email',
            ],
        ])

        ->add('password', PasswordType::class, [
            'label' => 'Mot de passe :',
            'required' => true,
            'attr' => [
                'placeholder' => '...',
                'class' => 'password',
            ],
        ])

        ->add('defaut_nbpers', ChoiceType::class, [
            'label' => 'Par défaut, lorsque vous réservez une table sur le site, pour combien de personne la voulez-vous ?',
            'required' => true,
            'choices' => [
                '1 pers.' => '1pers',
                '2 pers.' => '2pers',
                '3 pers.' => '3pers',
                '4 pers.' => '4pers',
                '5 pers.' => '5pers',
                '6 pers.' => '6pers',
            ],
            'choice_attr' => function() {
                return ['class' => 'radio'];
            },
            'expanded' => true,
            'multiple' => false,
            'attr' => ['class' => 'defaut_nbpers']
        ])

        ->add('allergie', TextareaType::class, [
            'label' => 'Indiquez dans le champ ci-dessous s’il y a des allergies dont vous voulez nous faire part :',
            'required' => false,
            'attr' => [
                'placeholder' => '...',
                'class' => 'textarea',
            ],
        ])

        ->add('submit', SubmitType::class, [
            'label' => "Je m'inscris",
            'attr' => ['class' => 'login_button'],
        ])

        ->get('defaut_nbpers')->addModelTransformer(new NbPersTransformer());
    }
}