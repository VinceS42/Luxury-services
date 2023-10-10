<?php

namespace App\Controller\Admin;

use App\Entity\Job;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use phpDocumentor\Reflection\Types\Integer;

class JobCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Job::class;
    }

 
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('client'),
            TextField::new('reference'),
            TextField::new('titleOffer'),
            MoneyField::new('salary')->setCurrency('EUR'),
            AssociationField::new('jobType')->autocomplete(),
            AssociationField::new('jobCategory')->autocomplete(),
            TextField::new('location'),
            DateField::new('strated_At'),
            TextareaField::new('description')->hideOnIndex(),
            BooleanField::new('isActivated'),
            TextareaField::new('note')->hideOnIndex(),
        ];
    }
   
}
