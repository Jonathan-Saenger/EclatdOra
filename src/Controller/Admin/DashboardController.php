<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Evenement;
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
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('EclatdOra');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-dashboard');
        yield MenuItem::linkToCrud('Evenement', 'fas fa-star', Evenement::class);
        yield MenuItem::linkToCrud('Article', 'fas fa-edit', Article::class);
        yield MenuItem::linkToUrl('Retour sur le site', 'fas fa-home', $this->generateUrl('app_home'));
    }
}
