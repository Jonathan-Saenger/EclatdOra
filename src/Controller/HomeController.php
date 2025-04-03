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
use App\Service\MailingService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mime\Email;


class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EvenementRepository $EvenementRepository, TemoignageRepository $temoignageRepository, Request $request, MailerInterface $mailer, EntityManagerInterface $entityManager, MailingService $mailingService): Response
    {
        $EmailInscription = new EmailInscription();
        $formEmail = $this->createForm(EmailInscriptionType::class, $EmailInscription);

        $result = $mailingService->newsletterInscription($formEmail, $request);

        if ($result['success']) {
            $this->addFlash('success', $result['message']);
            return $this->redirectToRoute('app_home');
        }

        $temoignages = new Temoignage();
        $temoignageForm = $this->createForm(TemoignageType::class, $temoignages);
        $temoignageForm->handleRequest($request);

        if ($temoignageForm->isSubmitted() && $temoignageForm->isValid()) {

            $data = $temoignageForm->getData();
            $nom = $data->getNom();
            $commentaire = $data->getCommentaire();
            $email = $data->getEmail();

            $email = (new Email())
                ->from($email)
                ->to('cedric.eclatdora@gmail.com')
                ->subject('Nouveau commentaire d\'un client')
                ->html("<p>Bonjour Cédric ! Tu as reçu un nouveau commentaire de ". $nom .". Rends toi dans ton espace pour le valider et le publier. Voici le commentaire : <br>
               <cite> ". $commentaire ." </cite>. ");

            $mailer->send($email);

            $entityManager->persist($temoignages);
            $entityManager->flush();

            $this->addFlash('success', 'Merci pour votre témoignage ! Il sera publié après validation.');

            return $this->redirectToRoute('app_home');
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'evenements' => $EvenementRepository->findBy([], ['createAt' => 'DESC'], 1),
            'temoignageForm' => $temoignageForm->createView(),
            'temoignages' => $temoignageRepository->findBy(['estValide' => '1']),
            'formEmail' => $formEmail->createView(),
        ]);
    }

    #[Route('/{page}', name:'app_juridique', requirements: ['page' => 'charte_plateau_therapeuthique|mentions_legales|conditions_generales|faq'])]
    public function juridiqueConditions(Request $request, MailingService $mailingService, String $page): Response
    {
        $EmailInscription = new EmailInscription();
        $formEmail = $this->createForm(EmailInscriptionType::class, $EmailInscription);

        $result = $mailingService->newsletterInscription($formEmail, $request);

        if ($result['success']) {
            $this->addFlash('success', $result['message']);
            return $this->redirectToRoute('app_home');
        }

        return $this->render(sprintf('home/%s.html.twig', $page), [
            'formEmail' => $formEmail->createView(),
        ]);
    }
}
