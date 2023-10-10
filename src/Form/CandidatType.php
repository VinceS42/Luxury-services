<?php

namespace App\Form;

use App\Entity\Candidat;
use App\Entity\CandidatExperience;
use App\Entity\Gender;
use App\Entity\JobCategory;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('gender', EntityType::class, [
                'class' => Gender::class
            ])


            ->add('firstname', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'first_name',
                    'required' => true,
                ]
            ])

            ->add('lastname', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'last_name',
                    'required' => true,
                ]
            ])

            ->add('localisation', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'current_location',
                    'required' => 'require',
                ]
            ])

            ->add('adress', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'address',
                    'required' => 'require',
                ]
            ])
            ->add('nationality', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'nationality',
                    'required' => 'require',
                ]
            ])

            ->add('country', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'country',
                ]
            ])

            // ->add('isPassport')


            ->add('birthdate', DateType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'birthdate'
                ],
                'widget' => 'single_text',
            ])

            ->add('birth_city', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'birth_city',
                ]
            ])


            ->add('jobcategory', EntityType::class, [
                'attr' => [
                    'id' => 'job_sector'
                ],
                'class' => JobCategory::class,
                'placeholder' => 'Choose an option...'

            ])

            ->add('experience', EntityType::class, [
                'class' => CandidatExperience::class,
            ])


            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'materialize-textarea',
                    'id' => 'description',
                    'clos' => 50,
                    'row' => 10,
                ]
            ])

            ->add('passport', FileType::class, [
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'id' => 'passport',
                    'size' => '200000',
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.gif',
                    'name' => 'passport',
                ]
            ])

            ->add('cv', FileType::class, [
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'id' => 'cv',
                    'size' => '200000',
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.gif',
                    'name' => 'cv',
                ]
            ])

            ->add('avatar', FileType::class, [
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'id' => 'photo',
                    'size' => '200000',
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.gif',
                    'name' => 'photo',
                ]
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidat::class,
        ]);
    }
}
