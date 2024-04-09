<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EvenementRepository $EvenementRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'evenements' => $EvenementRepository->findBy([], ['createAt' => 'DESC'], 1)
        ]);
    }

    #[Route('/charte_plateau_therapeuthique', name: 'app_charte_plateau_therapeuthique')]
    public function serviceCharte(): Response
    {
        return $this->render('home/charte_plateau_therapeuthique.html.twig', [
            'controller_name' => 'Controller',
        ]);
    }
}
