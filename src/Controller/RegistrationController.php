<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Entity\User;
use App\Form\RegistrationFormType;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, 
    EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            // creation d'un nouveau candidat pour set un user pour le profil

            $candidat = new Candidat();
            $candidat->setUser($user);
            // dd($candidat);
            
             // On set la date car elle ne peut pas etre nul dans la base de donnée
            $candidat->setCreatedAt(new DateTimeImmutable());
            $entityManager->persist($candidat);
            $entityManager->flush();
            // do anything else you need here, like send an email

            $email = (new Email())
            ->from('contact@luxury_services.com')
            ->to($user->getEmail())
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Click on the link to login')
            // ->text('Sending emails is fun again!')
            ->html('
            <h2>Well play, your account as been created</h2>
            <p>See Twig integration for better HTML integration!</p>
            ');

        $mailer->send($email);


            return $this->redirectToRoute('app_login');
        }

        return $this->render('register/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }


}
