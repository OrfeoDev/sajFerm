<?php

namespace App\Form;

use App\Entity\Depannage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DepannageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('nomDeEntreprise')
            ->add('description',)
            ->add('typeDePorte', ChoiceType::class,
                [
                    'label' => 'Type de porte ',
                    'attr' => ['class' => 'form-control'],
                    'placeholder' => '--Type de porte--',
                    'choices' => [' Sectionnelle' => 'Sectionnelle',
                        ' souple automatique' => 'souple',
                        'Empilable' => 'Empilable',
                        'Portail exterieur'=>'Portail exterieur',
                        'Rideau metablique'=>'Rideau metablique',]

                    ])

            ->add('typeDeMotorisation', ChoiceType::class, [
                'label' => 'Depannage',
                'attr' => ['class' => 'form-control'],
                'placeholder' => '--Choisir la puissance--',
                'choices' => ['Moteur 230 V' => 230,
                    'Moteur 400 V' => 400]


            ])
            ->add('numeroDeMotorisation')
            ->add('Envoyez', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Depannage::class,
        ]);
    }
}
