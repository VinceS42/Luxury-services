<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Entity\Candidature;
use App\Entity\Job;
use App\Form\CandidatureType;
use App\Repository\CandidatureRepository;
use App\Repository\JobRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/candidature')]

class CandidatureController extends AbstractController
{
    #[Route('/', name: 'app_candidature')]
    public function index(): Response
    {
        return $this->render('/index.html.twig', [
            'controller_name' => 'CandidatureController',
        ]);
    }

    #[Route('/new{id}', name: 'app_candidature_new', methods: ['GET', 'POST'])]
    public function new(Request $request,JobRepository $jobRepository, CandidatureRepository $candidatureRepository, EntityManagerInterface $entityManager, 
    Job $job): Response
    {
        /**
        * @var User $user
        */

        $user = $this->getUser();
        // $candidat = $user->getCandidat();        
        $candidature = $candidatureRepository->findOneBy([
            // 'candidat' => $candidat,
            'job' => $job,
        ]);
       
        if($candidature == null){

            $candidat = $user->getCandidat();
            $candidature = new Candidature();

            //remplissage entity candidature
            $candidature->setJob($job);
            $candidature->setCandidat($candidat);
            $candidature->setCreatedAt(new DateTimeImmutable());
           
            
            //remplissage table candidature
            $form = $this->createForm(CandidatureType::class, $candidature);
            $form->handleRequest($request);
            $entityManager->persist($candidature);
            $entityManager->flush();
        
            return $this->render('job/show.html.twig', [
                'candidat'=> $candidat,
                'job' => $job,
                'candidature'=>$candidature
            ]);
        }else{
            return $this->render('job/index.html.twig', [
                'jobs' => $jobRepository->findAll(),
            ]);
        }

        
    }
}
