<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EvenementController extends AbstractController
{
    #[Route('/evenement', name: 'app_evenement')]
    public function index(EvenementRepository $EvenementRepository): Response
    {
        return $this->render('evenement/evenement.html.twig', [
            'controller_name' => 'EvenementController',
            'evenements' => $EvenementRepository->findBy([], ['createAt' => 'DESC']) 
        ]);
    }
}
