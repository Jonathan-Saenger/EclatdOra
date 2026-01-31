<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\EmailInscriptionType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\EmailInscription;
use App\Service\MailingService;
use App\Service\CartService;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class PanierController extends AbstractController
{
    public function __construct(
        private CartService $cartService
    ) {
    }

    #[Route('/panier', name: 'app_panier')]
    public function index(Request $request, MailingService $mailingService): Response
    {
        $EmailInscription = new EmailInscription();
        $formEmail = $this->createForm(EmailInscriptionType::class, $EmailInscription);

        $result = $mailingService->newsletterInscription($formEmail, $request);

        if ($result['success']) {
            $this->addFlash('success', $result['message']);
            return $this->redirectToRoute('app_home');
        }

        return $this->render('panier/index.html.twig', [
            'controller_name' => 'PanierController',
            'formEmail' => $formEmail->createView(),
            'cart' => $this->cartService->getCart(),
            'total' => $this->cartService->getTotal(),
        ]);
    }

    #[Route('/panier/ajouter', name: 'app_panier_ajouter', methods: ['POST'])]
    public function ajouter(Request $request): Response
    {
        $id = $request->request->get('id');
        $titre = $request->request->get('titre');
        $duree = $request->request->get('duree');
        $prix = (float) $request->request->get('prix');

        if (!$id || !$titre || !$prix) {
            if ($request->isXmlHttpRequest()) {
                return new JsonResponse(['success' => false, 'message' => 'Données manquantes'], 400);
            }
            $this->addFlash('error', 'Impossible d\'ajouter cette prestation au panier.');
            return $this->redirectToRoute('app_panier');
        }

        $this->cartService->addItem($id, $titre, $duree, $prix);

        if ($request->isXmlHttpRequest()) {
            return new JsonResponse([
                'success' => true,
                'message' => 'Prestation ajoutée au panier',
                'cartCount' => $this->cartService->getItemCount(),
                'cartTotal' => $this->cartService->getTotal(),
            ]);
        }

        $this->addFlash('success', 'Prestation ajoutée au panier !');
        return $this->redirectToRoute('app_panier');
    }

    #[Route('/panier/supprimer/{id}', name: 'app_panier_supprimer', methods: ['POST'])]
    public function supprimer(string $id, Request $request): Response
    {
        $this->cartService->removeItem($id);

        if ($request->isXmlHttpRequest()) {
            return new JsonResponse([
                'success' => true,
                'message' => 'Prestation retirée du panier',
                'cartCount' => $this->cartService->getItemCount(),
                'cartTotal' => $this->cartService->getTotal(),
            ]);
        }

        $this->addFlash('success', 'Prestation retirée du panier.');
        return $this->redirectToRoute('app_panier');
    }

    #[Route('/panier/incrementer/{id}', name: 'app_panier_incrementer', methods: ['POST'])]
    public function incrementer(string $id, Request $request): Response
    {
        $this->cartService->incrementItem($id);

        if ($request->isXmlHttpRequest()) {
            return new JsonResponse([
                'success' => true,
                'cartCount' => $this->cartService->getItemCount(),
                'cartTotal' => $this->cartService->getTotal(),
                'cart' => $this->cartService->getCart(),
            ]);
        }

        return $this->redirectToRoute('app_panier');
    }

    #[Route('/panier/decrementer/{id}', name: 'app_panier_decrementer', methods: ['POST'])]
    public function decrementer(string $id, Request $request): Response
    {
        $this->cartService->decrementItem($id);

        if ($request->isXmlHttpRequest()) {
            return new JsonResponse([
                'success' => true,
                'cartCount' => $this->cartService->getItemCount(),
                'cartTotal' => $this->cartService->getTotal(),
                'cart' => $this->cartService->getCart(),
            ]);
        }

        return $this->redirectToRoute('app_panier');
    }

    #[Route('/panier/vider', name: 'app_panier_vider', methods: ['POST'])]
    public function vider(Request $request): Response
    {
        $this->cartService->clearCart();

        if ($request->isXmlHttpRequest()) {
            return new JsonResponse([
                'success' => true,
                'message' => 'Panier vidé',
            ]);
        }

        $this->addFlash('success', 'Votre panier a été vidé.');
        return $this->redirectToRoute('app_panier');
    }

    #[Route('/panier/count', name: 'app_panier_count', methods: ['GET'])]
    public function count(): JsonResponse
    {
        return new JsonResponse([
            'count' => $this->cartService->getItemCount(),
        ]);
    }

    #[Route('/panier/recapitulatif', name: 'app_panier_recapitulatif')]
    #[IsGranted('ROLE_USER')]
    public function recapitulatif(Request $request, MailingService $mailingService): Response
    {
        $cart = $this->cartService->getCart();
        
        // Rediriger vers le panier si celui-ci est vide
        if (empty($cart)) {
            $this->addFlash('warning', 'Votre panier est vide.');
            return $this->redirectToRoute('app_panier');
        }

        // Formulaire newsletter pour le footer
        $EmailInscription = new EmailInscription();
        $formEmail = $this->createForm(EmailInscriptionType::class, $EmailInscription);

        $result = $mailingService->newsletterInscription($formEmail, $request);

        if ($result['success']) {
            $this->addFlash('success', $result['message']);
            return $this->redirectToRoute('app_panier_recapitulatif');
        }

        return $this->render('panier/recapitulatif.html.twig', [
            'cart' => $cart,
            'total' => $this->cartService->getTotal(),
            'user' => $this->getUser(),
            'formEmail' => $formEmail->createView(),
        ]);
    }

    #[Route('/panier/valider', name: 'app_panier_valider', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function valider(): Response
    {
        // TODO: Implémenter la logique de validation de commande
        // Pour l'instant, rediriger vers la page construction
        return $this->redirectToRoute('app_construction');
    }
}
