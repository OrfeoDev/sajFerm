<?php

namespace App\Controller\Admin;

use App\Entity\Prospect;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProspectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Prospect::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
