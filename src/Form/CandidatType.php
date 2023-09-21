<?php

namespace App\Form;

use App\Entity\Candidat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('gender')
            ->add('firstname')
            ->add('lastname')
            ->add('localisation')
            ->add('city')
            ->add('nationality')
            ->add('isPassport')
            ->add('birthdate')
            ->add('birthCity')
            ->add('disponibility')
            ->add('sector')
            ->add('experience')
            ->add('description')
            ->add('note')
            ->add('createdAt')
            ->add('updateAt')
            ->add('deleteAt')
            ->add('passport')
            ->add('cv')
            ->add('avatar')
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidat::class,
        ]);
    }
}
