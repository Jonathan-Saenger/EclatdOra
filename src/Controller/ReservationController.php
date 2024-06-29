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

    // Validation du formulaire : le compléter avec l'envoi du formulaire vers Brevo
    
    //#[Route('/submit-reservation', name: 'route_name_to_handle_form_submission')]
    //public function handleFormSubmission(Request $request, ReservationRepository $reservationRepository, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    //{
    //    $reservationId = $request->request->get('reservation');
    //   if ($reservationId) {
    //       $reservation = $reservationRepository->find($reservationId);

            // Logic to handle the selected reservation
            // For example, you can send an email, save to database, etc.

    //       $this->addFlash('success', 'Votre réservation a été prise en compte pour le créneau sélectionné.');
    //       return $this->redirectToRoute('some_route_after_submission');
    //   }

    //   $this->addFlash('error', 'Veuillez sélectionner un créneau.');
    //   return $this->redirectToRoute('current_route_with_form'); // Replace with the route name where the form is displayed
    //}
}


