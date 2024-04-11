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
    public function juridiqueCharte(): Response
    {
        return $this->render('home/charte_plateau_therapeuthique.html.twig');
    }

    #[Route('/mentions_legales', name:'app_mentions_legales')]
    public function juridiqueMentions(): Response
        {
            return $this->render('home/mentions_legales.html.twig');
        }

    #[Route('/conditions_generales', name:'app_conditions_generales')]
    public function juridiqueConditions(): Response
        {
            return $this->render('home/conditions_generales.html.twig');
        }
}
