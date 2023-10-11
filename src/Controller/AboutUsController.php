<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/about')]
class AboutUsController extends AbstractController
{
    #[Route('/', name: 'app_about_us')]
    public function index(): Response
    {
        return $this->render('about/aboutus.html.twig', [
            'controller_name' => 'AboutUsController',
        ]);
    }
}
