<?php

namespace App\Controller;

use App\Entity\Prospect;
use App\Form\DemandeProspectType;
use App\Services\MailerService;
use App\Services\Messages;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    protected $service;

    public function __construct(MailerInterface $mailer, MailerService $service)
    {
        $this->service = $service;
    }

    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $em, MailerService $service): Response
    {
        $prospect = new Prospect();
        $form = $this->createForm(DemandeProspectType::class, $prospect);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {


            $em->persist($prospect);
            $em->flush();

            $nom = $prospect->getNom();
            $mail = $prospect->getEmail();
            $client = $prospect->getDemandeDeDevis();

            $service->sendMail($mail);

            $this->addFlash('success', 'Votre demande a bien ete envoyée');
        }
        return $this->render('contact/index.html.twig', [
            'formulaire' => $form->createView()
        ]);
    }


}
