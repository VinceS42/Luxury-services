<?php

namespace App\Controller\Admin;

use App\Entity\CandidatExperience;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CandidatExperienceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CandidatExperience::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('name'),

        ];
    }

}
