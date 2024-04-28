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

class FormulaireContactController extends AbstractController
{
    #[Route('/formulaire/contact', name: 'app_formulaire_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {   
        $contact = new Contact();
        $form = $this->createForm(FormulaireContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            $nom = $data->getNom();
            $prenom = $data->getPrenom();
            $email = $data->getEmail();
            $telephone = $data->getTelephone();
            $message = $data->getMessage();

            $email = (new Email())
                ->from($email)
                ->to('to@example.com')
                ->subject('Formulaire de contact')
                ->text($message)
                ->html("<p>Bonjour Cédric ! Tu as reçu une demande de contact de " . $prenom . "  " . $nom . " ! Son numéro de téléphone est 
                le 0" . $telephone . " . Voici son message : " . $message . " </p>");
                
            $mailer->send($email);

            return $this->redirectToRoute('app_submit'); //route à créer
        }

        return $this->render('formulaire_contact/contact.html.twig', [
            'form' => $form,
        ]);
    }

        #[Route('/_submit', name: 'app_submit')]
        public function submit() : Response
        {
            return $this->render('formulaire_contact/_submit.html.twig');
        }
}
