<?php

namespace App\Form;

use App\Entity\Prospect;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;


class DemandeProspectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,['label' => 'Nom','attr'=>[
                'placeholder'=>'Entrez votre nom'
            ]
            ])
            ->add('prenom',TextType::class,['label' => 'Prenom','attr'=>[
                'placeholder'=>'Entrez votre prenom'
            ]])
            ->add('email',EmailType::class,['label' => 'Email','attr'=>[
                'placeholder'=>'Entrez votre adresse email'
            ]])
            ->add('telephone',TelType::class,['label' => 'Telephone','attr'=>[
                'placeholder'=>'Entrez votre numero de telephone'
            ]])
            ->add('demandeDeDevis',TextareaType::class,['attr'=>[
                'placeholder'=>'Decrivrez votre demande'
            ]])
            ->add('image', FileType::class, [
                'label' => 'Telecharger votre fichier (PDF file)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                            'image/png',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ],
            ])  ->add('rgpd',CheckboxType::class,['mapped'=>false])
            ->add('Envoyez',SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Prospect::class,
        ]);
    }
}
