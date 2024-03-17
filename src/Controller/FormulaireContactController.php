<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\FormulaireContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FormulaireContactController extends AbstractController
{
    #[Route('/formulaire/contact', name: 'app_formulaire_contact')]
    public function index(Request $request): Response
    {   
        $contact = new Contact();
        $form = $this->createForm(FormulaireContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('app_contact_success'); //route à créer
        }


        return $this->render('formulaire_contact/contact.html.twig', [
            'form' => $form,
        ]);
    }
}
