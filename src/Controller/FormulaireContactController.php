<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\FormulaireContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\EmailInscription;
use App\Form\EmailInscriptionType;
use App\Service\MailingService;

class FormulaireContactController extends AbstractController
{
    #[Route('/formulaire/contact', name: 'app_formulaire_contact')]
    public function index(Request $request, MailerInterface $mailer, MailingService $mailingService): Response
    {
        $contact = new Contact();
        $form = $this->createForm(FormulaireContactType::class, $contact);
        $form->handleRequest($request);

        $EmailInscription = new EmailInscription();
        $formEmail = $this->createForm(EmailInscriptionType::class, $EmailInscription);

        $result = $mailingService->newsletterInscription($formEmail, $request);

        if ($result['success']) {
            $this->addFlash('success', $result['message']);
            return $this->redirectToRoute('app_home');
        }

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            $nom = $data->getNom();
            $prenom = $data->getPrenom();
            $email = $data->getEmail();
            $telephone = $data->getTelephone();
            $message = $data->getMessage();

            $email = (new Email())
                ->from($email)
                ->to('cedric.eclatdora@gmail.com')
                ->subject('Formulaire de contact')
                ->text($message)
                ->html("<p>Bonjour Cédric ! Tu as reçu une demande de contact de " . $prenom . "  " . $nom . " ! Son numéro de téléphone est
                le 0" . $telephone . " . Voici son message : " . $message . " </p>");

            $mailer->send($email);

            return $this->redirectToRoute('app_submit'); //route à créer
        }

        return $this->render('formulaire_contact/contact.html.twig', [
            'form' => $form,
            'formEmail' => $formEmail->createView(),
        ]);
    }

    #[Route('/_submit', name: 'app_submit')]
    public function submit() : Response
    {
        return $this->render('formulaire_contact/_submit.html.twig');
    }

    #[Route('/_inscription', name: 'app_inscription')]
    public function inscriptionEmail(Request $request, MailingService $mailingService) : Response
    {
        $EmailInscription = new EmailInscription();
        $formEmail = $this->createForm(EmailInscriptionType::class, $EmailInscription);

        $result = $mailingService->newsletterInscription($formEmail, $request);

            if ($result['success']) {
                $this->addFlash('success', $result['message']);
            return $this->redirectToRoute('app_inscription');
        }

        return $this->render('formulaire_contact/_inscription.html.twig');
    }
}
