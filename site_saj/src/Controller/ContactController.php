<?php

namespace App\Controller;

use App\Entity\Prospect;
use App\Form\DemandeProspectType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{

    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request,EntityManagerInterface $em): Response
    {
        $prospect = new Prospect();
        $form = $this->createForm(DemandeProspectType::class, $prospect);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid())
        {
        $em->persist($prospect);
        $em->flush();
        }
        return $this->render('contact/index.html.twig', [
            'formulaire' => $form->createView()
        ]);
    }
}
