<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\EmailInscription;
use App\Form\EmailInscriptionType;
use Symfony\Component\HttpFoundation\Request;
use App\Service\MailingService;

class FormationReikiController extends AbstractController
{
    #[Route('/formation/reiki', name: 'app_formation')]
    public function index(Request $request, MailingService $mailingService): Response
    {
        $EmailInscription = new EmailInscription();
        $formEmail = $this->createForm(EmailInscriptionType::class, $EmailInscription);

        $result = $mailingService->newsletterInscription($formEmail, $request);

        if ($result['success']) {
            $this->addFlash('success', $result['message']);
            return $this->redirectToRoute('app_home');
        }

        return $this->render('formation_reiki/formation.html.twig', [
            'controller_name' => 'FormationReikiController',
            'formEmail' => $formEmail->createView(),
        ]);
    }
}
