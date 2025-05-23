<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\EmailInscription;
use App\Form\EmailInscriptionType;
use App\Service\MailingService;
use Symfony\Component\HttpFoundation\Request;

class CadeauxController extends AbstractController
{
    #[Route('/cadeaux', name: 'app_cadeaux')]
    public function index(Request $request, MailingService $mailingService): Response
    {
        $EmailInscription = new EmailInscription();
        $formEmail = $this->createForm(EmailInscriptionType::class, $EmailInscription);

        $result = $mailingService->newsletterInscription($formEmail, $request);

        if ($result['success']) {
            $this->addFlash('success', $result['message']);
            return $this->redirectToRoute('app_home');
        }

        return $this->render('cadeaux/cadeaux.html.twig', [
            'controller_name' => 'CadeauxController',
            'formEmail' => $formEmail->createView(),
        ]);
    }
}
