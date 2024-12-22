<?php

namespace App\Service;

use App\Entity\EmailInscription;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailingService
{
    public function __construct(
      private EntityManagerInterface $entityManager,
      private MailerInterface $mailer
    ) {}

    public function newsletterInscription(FormInterface $form, Request $request): array
    {
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();
            $subscriberEmail = $data->getEmail();

            $this->sendConfirmationEmail($subscriberEmail);
            $this->saveSubscription($data);

            return [
                'success' => true,
                'message' => "Merci ! Votre demande d'inscription à la newsletter a bien été prise en compte !"
            ];
        }

        return ['success' => false];
    }

    private function sendConfirmationEmail(string $subscriberEmail) : void
    {
        $email = (new Email())
          ->from($subscriberEmail)
          ->to('cedric.eclatdora@gmail.com')
          ->subject('Demande d\'inscription à la newsletter')
          ->html("<p>Bonjour Cédric ! Tu as reçu une inscription à la newletter. Voici le mail du nouvel inscrit ". $subscriberEmail ." </p>");

        $this->mailer->send($email);
    }

    private function saveSubscription(EmailInscription $emailInscription) : void
    {
        $this->entityManager->persist($emailInscription);
        $this->entityManager->flush();
    }
}
