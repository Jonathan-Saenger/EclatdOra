<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CadeauxController extends AbstractController
{
    #[Route('/cadeaux', name: 'app_cadeaux')]
    public function index(): Response
    {
        return $this->render('cadeaux/cadeaux.html.twig', [
            'controller_name' => 'CadeauxController',
        ]);
    }
}
