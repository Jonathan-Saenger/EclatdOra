<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\EmailInscription;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use App\Form\EmailInscriptionType;
use Symfony\Component\HttpFoundation\Request;

class ServicesController extends AbstractController
{
    private $mailer;
    private $entityManager;

    public function __construct(MailerInterface $mailer, EntityManagerInterface $entityManager)
    {
        $this->mailer = $mailer;
        $this->entityManager = $entityManager;
    }

    #[Route('/services', name: 'app_services')]
    public function index(Request $request): Response
    {
        return $this->handleServiceRequest($request, 'services/services.html.twig');
    }

    #[Route('/_meditation', name: 'app_meditation')]
    public function serviceMediation(Request $request): Response
    {
        return $this->handleServiceRequest($request, 'services/_meditation.html.twig');
    }

    #[Route('/_lucia', name: 'app_lucia')]
    public function serviceLucia(Request $request): Response
    {
        return $this->handleServiceRequest($request, 'services/_lucia.html.twig');
    }

    #[Route('/_hypnose', name: 'app_hypnose')]
    public function serviceHypnose(Request $request): Response
    {
        return $this->handleServiceRequest($request, 'services/_hypnose.html.twig');
    }

    #[Route('/_soins', name: 'app_soins')]
    public function serviceSoins(Request $request): Response
    {
        return $this->handleServiceRequest($request, 'services/_soins.html.twig');
    }

    #[Route('/_medium', name: 'app_medium')]
    public function serviceMedium(Request $request): Response
    {
        return $this->handleServiceRequest($request, 'services/_medium.html.twig');
    }

    #[Route('/_constellation', name: 'app_constellation')]
    public function serviceConstellation(Request $request): Response
    {
        return $this->handleServiceRequest($request, 'services/_constellation.html.twig');
    }

    private function handleServiceRequest(Request $request, string $template): Response
    {
        $emailInscription = new EmailInscription();
        $formEmail = $this->createForm(EmailInscriptionType::class, $emailInscription);
        $formEmail->handleRequest($request);

        if ($formEmail->isSubmitted() && $formEmail->isValid()) {
            $email = $emailInscription->getEmail();

            $this->sendEmail($email);
            $this->saveEmailInscription($emailInscription);

            $this->addFlash('success', 'Merci ! Votre demande d\'inscription à la newsletter a bien été prise en compte !');
            return $this->redirectToRoute('app_home');
        }

        return $this->render($template, [
            'controller_name' => 'ServicesController',
            'formEmail' => $formEmail->createView(),
        ]);
    }

    private function sendEmail(string $subscriberEmail): void
    {
        $email = (new Email())
            ->from($subscriberEmail)
            ->to('cedric.eclatdora@gmail.com')
            ->subject('Demande d\'inscription à la newsletter')
            ->html("<p>Bonjour Cédric ! Tu as reçu une inscription à la newsletter. Voici le mail du nouvel inscrit " . $subscriberEmail . "</p>");

        $this->mailer->send($email);
    }

    private function saveEmailInscription(EmailInscription $emailInscription): void
    {
        $this->entityManager->persist($emailInscription);
        $this->entityManager->flush();
    }
}
