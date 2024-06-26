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

class FormationReikiController extends AbstractController
{
    #[Route('/formation/reiki', name: 'app_formation')]
    public function index(Request $request, MailerInterface $mailer, EntityManagerInterface $entityManager): Response
    {
        $EmailInscription = new EmailInscription();
        $formEmail = $this->createForm(EmailInscriptionType::class, $EmailInscription);
        $formEmail->handleRequest($request);
        if ($formEmail->isSubmitted() && $formEmail->isValid()) {

            $data = $formEmail->getData();
            $email = $data->getEmail();

            $email = (new Email())
                ->from($email)
                ->to('cedric.eclatdora@gmail.com')
                ->subject('Demande d\'inscription à la newsletter')
                ->html("<p>Bonjour Cédric ! Tu as reçu une inscription à la newletter. Voici le mail du nouvel inscrit ". $email ." ");

            $mailer->send($email);

            $entityManager->persist($EmailInscription);
            $entityManager->flush();

            $this->addFlash('success', 'Merci ! Votre demande d\'inscription à la newsletter a bien été prise en compte !');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('formation_reiki/formation.html.twig', [
            'controller_name' => 'FormationReikiController',
            'formEmail' => $formEmail->createView(),
        ]);
    }
}
