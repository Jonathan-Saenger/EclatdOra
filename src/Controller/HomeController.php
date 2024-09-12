<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mailer\MailerInterface;
use App\Form\EmailInscriptionType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\EmailInscription;
use App\Entity\Temoignage;
use App\Form\TemoignageType;
use App\Repository\TemoignageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mime\Email;


class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EvenementRepository $EvenementRepository, TemoignageRepository $temoignageRepository, Request $request, MailerInterface $mailer, EntityManagerInterface $entityManager): Response
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

        $temoignage = new Temoignage();
        $temoignageForm = $this->createForm(TemoignageType::class, $temoignage);
        $temoignageForm->handleRequest($request);

        if ($temoignageForm->isSubmitted() && $temoignageForm->isValid()) {
            
            $data = $temoignageForm->getData();
            $nom = $data->getNom();
            $email = $data->getEmail();
            $commentaire = $data->getCommentaire();

            $email = (new Email())
                ->from($email)
                ->to('cedric.eclatdora@gmail.com')
                ->subject('Nouveau commentaire reçu')
                ->text($commentaire)
                ->html("<p>Bonjour Cédric ! Tu as reçu un commentaire de " . $nom . " ! Rends toi dans ton espace de gestion  
                pour le valider afin qu'il soit publié sur la page d'accueil ! </p>");
                
            $mailer->send($email);
            
            $entityManager->persist($temoignage);
            $entityManager->flush();
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'evenements' => $EvenementRepository->findBy([], ['createAt' => 'DESC'], 1),
            'temoignageForm' => $temoignageForm->createView(),
            'temoignage' => $temoignageRepository,
            'formEmail' => $formEmail->createView(),
        ]);
    }

    #[Route('/charte_plateau_therapeuthique', name: 'app_charte_plateau_therapeuthique')]
    public function juridiqueCharte(Request $request, MailerInterface $mailer, EntityManagerInterface $entityManager): Response
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

        return $this->render('home/charte_plateau_therapeuthique.html.twig', [
            'formEmail' => $formEmail->createView(),
        ]);
    }

    #[Route('/mentions_legales', name:'app_mentions_legales')]
    public function juridiqueMentions(Request $request, MailerInterface $mailer, EntityManagerInterface $entityManager): Response
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

            return $this->render('home/mentions_legales.html.twig', [
                'formEmail' => $formEmail->createView(),
            ]);
        }

    #[Route('/conditions_generales', name:'app_conditions_generales')]
    public function juridiqueConditions(Request $request, MailerInterface $mailer, EntityManagerInterface $entityManager): Response
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

            return $this->render('home/conditions_generales.html.twig', [
                'formEmail' => $formEmail->createView(),
            ]);
        }
}
