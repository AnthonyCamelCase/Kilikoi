<?php

namespace App\Controller\Admin;

use App\Entity\Saga;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;


class SagaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Saga::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nomSaga'),
            IntegerField::new('volume'),
        ];
    }
}
