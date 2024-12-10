<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ConstructionController extends AbstractController
{
    #[Route('/construction', name: 'app_construction')]
    public function index(): Response
    {
        return $this->render('construction.html.twig', [
            'controller_name' => 'ConstructionController',
        ]);
    }
}
