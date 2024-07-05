<?php

namespace App\Controller\Admin;

use App\Entity\EmailInscription;
use App\Entity\User;
use App\Entity\Evenement;
use App\Entity\Reservation;
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
        yield MenuItem::linkToCrud('Membres', 'fa fa-user', User::class);
        yield MenuItem::linkToCrud('Inscrits Newsletter', 'fa fa-envelope', EmailInscription::class);
        yield MenuItem::linkToCrud('Réservations', 'fa-regular fa-calendar', Reservation::class);
        yield MenuItem::linkToUrl('Retour sur le site', 'fas fa-home', $this->generateUrl('app_home'));
    }
}
