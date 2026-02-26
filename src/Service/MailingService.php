<?php

namespace App\Service;

use App\Entity\EmailInscription;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Core\User\UserInterface;
use Twig\Environment;

class MailingService
{
    public function __construct(
      private EntityManagerInterface $entityManager,
      private MailerInterface $mailer,
      private Environment $twig
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

    public function sendOrderNotification(UserInterface $user, array $cart, float $total): void
    {
        if (!$user instanceof User) {
            throw new \InvalidArgumentException('L\'utilisateur doit être une instance de App\\Entity\\User');
        }

        $htmlContent = $this->twig->render('emails/commande_notification.html.twig', [
            'user' => $user,
            'cart' => $cart,
            'total' => $total,
        ]);

        $email = (new Email())
            ->from('cedric.eclatdora@gmail.com')
            ->replyTo($user->getEmail())
            ->to('cedric.eclatdora@gmail.com')
            ->subject('Nouvelle commande de ' . $user->getPrenom() . ' ' . $user->getNom())
            ->html($htmlContent);

        $this->mailer->send($email);
    }
}
