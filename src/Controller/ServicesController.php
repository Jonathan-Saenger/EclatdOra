<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ServicesController extends AbstractController
{
    #[Route('/services', name: 'app_services')]
    public function index(): Response
    {
        return $this->render('services/services.html.twig', [
            'controller_name' => 'ServicesController',
        ]);
    }

    #[Route('/_meditation', name: 'app_meditation')]
    public function serviceMediation(): Response
    {
        return $this->render('services/_meditation.html.twig', [
            'controller_name' => 'Controller',
        ]);
    }

    #[Route('/_lucia', name: 'app_lucia')]
    public function serviceLucia(): Response
    {
        return $this->render('services/_lucia.html.twig', [
            'controller_name' => 'Controller',
        ]);
    }

    #[Route('/_hypnose', name: 'app_hypnose')]
    public function serviceHypnose(): Response
    {
        return $this->render('services/_hypnose.html.twig', [
            'controller_name' => 'Controller',
        ]);
    }

    #[Route('/_soins', name: 'app_soins')]
    public function serviceSoins(): Response
    {
        return $this->render('services/_soins.html.twig', [
            'controller_name' => 'SoinsController',
        ]);
    }

    #[Route('/_medium', name: 'app_medium')]
    public function serviceMedium(): Response
    {
        return $this->render('services/_medium.html.twig', [
            'controller_name' => 'MediumController',
        ]);
    }
    
}
