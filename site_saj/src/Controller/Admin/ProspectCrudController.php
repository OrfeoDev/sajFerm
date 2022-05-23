<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use App\Entity\Prospect;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProspectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {

        return Prospect::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            TextField::new('prenom'),
            EmailField::new('email')->setFormTypeOption('disabled', 'disabled'),
            TelephoneField::new('telephone'),
            TextEditorField::new('demandeDeDevis'),
            TextField::new('image')->setFormType(VichImageType::class),
            ImageField::new('image')->setBasePath('/uploads/prospects/')->onlyOnIndex(),



        ];
    }

}
