<?php

namespace App\Controller\Admin;

use App\Entity\Candidat;
use App\Entity\CandidatExperience;
use App\Entity\Candidature;
use App\Entity\Client;
use App\Entity\Gender;
use App\Entity\Job;
use App\Entity\JobCategory;
use App\Entity\JobType;
use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Luxury Services');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');


        yield MenuItem::subMenu('Clients', 'fas fa-folder')
        ->setSubItems([
            MenuItem::linkToCrud('Client', 'fas fa-list', Client::class),
            MenuItem::linkToCrud('Job', 'fas fa-list', Job::class),
            MenuItem::linkToCrud('JobCategory', 'fas fa-list', JobCategory::class),
            MenuItem::linkToCrud('JobType', 'fas fa-list', JobType::class),
        ]);

        yield MenuItem::subMenu('Candidats', 'fas fa-folder')
        ->setSubItems([
            MenuItem::linkToCrud('Candidat', 'fas fa-list', Candidat::class),
            MenuItem::linkToCrud('Candidature', 'fas fa-list', Candidature::class),
            MenuItem::linkToCrud('Gender', 'fas fa-list', Gender::class),
            MenuItem::linkToCrud('CandidatExperience', 'fas fa-list', CandidatExperience::class),
        ]);



    }
}
