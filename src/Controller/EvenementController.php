<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\EmailInscription;
use App\Form\EmailInscriptionType;
use App\Service\MailingService;
use Symfony\Component\HttpFoundation\Request;

class EvenementController extends AbstractController
{
    #[Route('/evenement', name: 'app_evenement')]
    public function index(EvenementRepository $EvenementRepository, Request $request, MailingService $mailingService): Response
    {
        $EmailInscription = new EmailInscription();
        $formEmail = $this->createForm(EmailInscriptionType::class, $EmailInscription);

        $result = $mailingService->newsletterInscription($formEmail, $request);

        if ($result['success']) {
            $this->addFlash('success', $result['message']);
            return $this->redirectToRoute('app_home');
        }

        return $this->render('evenement/evenement.html.twig', [
            'controller_name' => 'EvenementController',
            'evenements' => $EvenementRepository->findBy([], ['createAt' => 'DESC']),
            'formEmail' => $formEmail->createView(),
        ]);
    }
}
