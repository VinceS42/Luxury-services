<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Entity\Media;
use App\Entity\User;
use App\Form\CandidatType;
use App\Repository\CandidatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

#[Route('/candidat')]
class CandidatController extends AbstractController
{
    #[Route('/', name: 'app_candidat_profil')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        /**
         * @var User $user
         */


        $user = $this->getUser();
        $candidat = $user->getCandidat();

        $formProfil = $this->createForm(CandidatType::class, $candidat);
        $formProfil->handleRequest($request);

        if ($formProfil->isSubmitted() && $formProfil->isValid()) {

            if ($formProfil['avatar']->getData()) {

                /**
                 **@var UploadedFile $avatarFile
                 */

                $avatarFile = $formProfil['avatar']->getData();
                //  dd($avatarFile);
                $avatarFileName = Uuid::v7();

                $extension = $avatarFile->guessExtension();
                if (!$extension) {
                    $extension = 'png';
                }


                $avatarFileName = $avatarFileName . "." . $extension;

                $avatarFile->move('media/avatar', $avatarFileName);

                $avatarFileMedia = new Media();
                $avatarFileMedia->setUrl($avatarFileName);
                $avatarFileMedia->setOriginalName($avatarFile->getClientOriginalName());
                //  dd($avatarFileMedia);


                $entityManager->persist($avatarFileMedia);

                $candidat->setAvatar($avatarFileMedia);
                $entityManager->persist($candidat);
                //  dd($candidat);
            }



            if ($formProfil['passport']->getData()) {



                /**
                 **@var UploadedFile $passportFile
                 */

                $passportFile = $formProfil['passport']->getData();
                //  dd($passportFile);


                    $passportFileName = Uuid::v7();

                    $extension = $passportFile->guessExtension();
                    if (!$extension) {
                        $extension = 'png';
                    }


                    $passportFileName = $passportFileName . "." . $extension;

                    $passportFile->move('media/passport', $passportFileName);

                    $passportFileMedia = new Media();
                    $passportFileMedia->setUrl($passportFileName);
                    $passportFileMedia->setOriginalName($passportFile->getClientOriginalName());
                    //  dd($passportFileMedia);


                    $entityManager->persist($passportFileMedia);

                    $candidat->setPassport($passportFileMedia);
                    $entityManager->persist($candidat);
                    //  dd($candidat);
                
            }

            
            if ($formProfil['cv']->getData()) {

                /**
                 **@var UploadedFile $cvFile
                 */

                $cvFile = $formProfil['cv']->getData();
                //  dd($cvFile);
                $cvFileName = Uuid::v7();

                $extension = $cvFile->guessExtension();
                if (!$extension) {
                    $extension = 'png';
                }


                $cvFileName = $cvFileName . "." . $extension;

                $cvFile->move('media/cv', $cvFileName);

                $cvFileMedia = new Media();
                $cvFileMedia->setUrl($cvFileName);
                $cvFileMedia->setOriginalName($cvFile->getClientOriginalName());
                //  dd($cvFileMedia);


                $entityManager->persist($cvFileMedia);

                $candidat->setCv($cvFileMedia);
                $entityManager->persist($candidat);
                //  dd($candidat);
            }

            // dd($candidat);

            $entityManager->flush();


            // return $this->redirectToRoute('')
        }



        return $this->render('candidat/profil.html.twig', [
            'formProfil' =>  $formProfil,
            'candidat' => $candidat
        ]);
    }
}
