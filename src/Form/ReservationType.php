<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\NbPersTransformer;


class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = new User();

        $builder
            ->add('nbpers', ChoiceType::class, [
                'label' => 'Nombre de personnes :',
                'choices' => [
                    '1 pers.' => '1pers',
                    '2 pers.' => '2pers',
                    '3 pers.' => '3pers',
                    '4 pers.' => '4pers',
                    '5 pers.' => '5pers',
                    '6 pers.' => '6pers',
                ],
                'choice_attr' => function($choice, $key, $value) {
                    return ['class' => 'radio'];
                },
                'expanded' => true,
                'multiple' => false,
                'attr' => ['class' => 'nbpers'],
                'data' => in_array('ROLE_USER', $user->getRoles()) ? $user->getDefautNbpers() : null
            ])

           
            ->add('jour', DateType::class, [
                'label' => 'A la date du :',
                'widget' => 'single_text',
                'attr' => [
                    'min' => '2023-05-01', 'max' => '2024-06-30',
                    'class' => 'date'
                ],
            ])

            ->add('heure_dej', ChoiceType::class, [
                'label' => 'Déjeuner :',
                'choices' => [
                    '11h30' => '11h30',
                    '11h45' => '11h45',
                    '12h00' => '12h00',
                    '12h15' => '12h15',
                    '12h30' => '12h30',
                    '12h45' => '12h45',
                    '13h00' => '13h00',
                    '13h15' => '13h15',
                    '13h30' => '13h30',
                ],
                'choice_attr' => function() {
                    return ['class' => 'radio'];
                },
                'expanded' => true,
                'multiple' => false,
                'attr' => ['class' => 'heures']
            ])

            ->add('heure_diner', ChoiceType::class, [
                'label' => 'Dîner :',
                'choices' => [
                    '19h30' => '19h30',
                    '19h45' => '19h45',
                    '20h00' => '20h00',
                    '20h15' => '20h15',
                    '20h30' => '20h30',
                    '20h45' => '20h45',
                    '21h00' => '21h00',
                    '21h15' => '21h15',
                    '21h30' => '21h30',
                ],
                'choice_attr' => function() {
                    return ['class' => 'radio'];
                },
                'expanded' => true,
                'multiple' => false,
                'attr' => ['class' => 'heures']
            ])

            ->add('allergies', TextareaType::class, [
                'label' => "Indiquez dans le champ ci-dessous s’il y a des allergies dont vous voulez nous faire part :",
                'attr' => [
                    'rows' => '3', 'cols' => '40',
                    'class' => 'allergie'
                    ]
            ])
            
            ->add('submit', SubmitType::class, [
                'label' => "Réserver",
                'attr' => ['class' => 'login_button'],
            ])

            ->get('nbpers')->addModelTransformer(new NbPersTransformer());
    }
}