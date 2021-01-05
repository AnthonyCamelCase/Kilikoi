<?php

namespace App\Controller\Admin;

use App\Entity\ListeDeLecture;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ListeDeLectureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ListeDeLecture::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom_liste'),
            AssociationField::new('utilisateur')->setValue('Utilisateur'),
            AssociationField::new('livre')->setValue('Livre'),
        ];
    }
}
