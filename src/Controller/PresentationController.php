<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\EmailInscription;
use App\Form\EmailInscriptionType;
use App\Service\MailingService;
use Symfony\Component\HttpFoundation\Request;


class PresentationController extends AbstractController
{
    #[Route('/presentation', name: 'app_presentation')]
    public function index(Request $request, MailingService $mailingService): Response
    {
        $EmailInscription = new EmailInscription();
        $formEmail = $this->createForm(EmailInscriptionType::class, $EmailInscription);

        $result = $mailingService->newsletterInscription($formEmail, $request);

        if ($result['success']) {
            $this->addFlash('success', $result['message']);
            return $this->redirectToRoute('app_home');
        }

        return $this->render('presentation/presentation.html.twig', [
            'controller_name' => 'PresentationController',
            'formEmail' => $formEmail->createView(),
        ]);
    }
}
