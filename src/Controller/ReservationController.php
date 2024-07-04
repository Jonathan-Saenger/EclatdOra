<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use App\Form\EmailInscriptionType;
use App\Entity\EmailInscription;
use App\Repository\ReservationRepository;
use Symfony\Component\Security\Core\User\UserInterface;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(Request $request, ReservationRepository $ReservationRepository, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
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

        return $this->render('reservation/reservation.html.twig', [
            'reservation' => $ReservationRepository->findBy([], ['date' => 'ASC']),
            'formEmail' => $formEmail->createView(),
        ]);
    }

    #[Route('/reservation/{prestation}', name: 'reservation_prestation')]
    public function reservationParPrestation(string $prestation, Request $request, ReservationRepository $reservationRepository, EntityManagerInterface $entityManager,
     MailerInterface $mailer): Response
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
        // Récupérez les réservations pour la prestation donnée
        $reservation = $reservationRepository->findBy(['prestation' => $prestation], ['date' => 'ASC']);

        return $this->render('reservation/reservation.html.twig', [
            'reservation' => $reservation,
            'prestation' => $prestation,
            'formEmail' => $formEmail->createView(),
        ]);
    }
    
    #[Route('/reservation/submit/{id}', name: 'reservation_submit')]
    public function submitReservation(int $id, ReservationRepository $reservationRepository, MailerInterface $mailer, UserInterface $user): Response
    {
        $reservation = $reservationRepository->find($id);

        if (!$reservation) {
            throw $this->createNotFoundException('Réservation non trouvée.');
        }

        $email = (new Email())
            ->from('no-reply@votre-site.com')
            ->to('cedric.eclatdora@gmail.com') 
            ->subject('Nouvelle réservation')
            ->html("<p>Bonjour Cédric, une nouvelle réservation a été effectuée pour la prestation : <strong>{$reservation->getPrestation()}</strong>.</p>
                    Voici le créneau choisi : <p>Date :<strong> {$reservation->getDate()->format('d/m/Y')} de {$reservation->getDebut()->format('H:i')} à {$reservation->getFin()->format('H:i')}.</strong></p>
                    Le client est : <strong>{$user->getNom()} {$user->getPrenom()}</strong>, son email est : <strong>{$user->getEmail()}</strong> et son numéro de téléphone est : <strong>0{$user->getTelephone()}</strong>.");

        $mailer->send($email);

        $this->addFlash('success', 'Votre réservation a été envoyée !');
        return $this->redirectToRoute('app_home'); // Créer un visuel pour la validation de la réservation
    }
}
