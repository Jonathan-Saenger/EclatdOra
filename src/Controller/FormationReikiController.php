<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FormationReikiController extends AbstractController
{
    #[Route('/formation/reiki', name: 'app_formation')]
    public function index(): Response
    {
        return $this->render('formation_reiki/formation.html.twig', [
            'controller_name' => 'FormationReikiController',
        ]);
    }
}
