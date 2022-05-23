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
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class ContactController extends AbstractController
{
    protected $service;

    public function __construct(MailerInterface $mailer, MailerService $service)
    {
        $this->service = $service;
    }

    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $em, MailerService $service, SluggerInterface $slugger): Response
    {
        $prospect = new Prospect();
        $form = $this->createForm(DemandeProspectType::class, $prospect);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();


            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);

                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();


                try {
                    $image->move(
                        $this->getParameter('prospect_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {

                }


                $prospect->setImage($newFilename);

            }
            $em->persist($prospect);
            // ... persist the $product variable or any other work
            $em->flush();

            $nom = $prospect->getNom();
            $mail = $prospect->getEmail();
            $message = $prospect->getDemandeDeDevis();

            $service->sendMail("Demande","".''."Vous avez une nouvelle demande de devis de ".' '.$prospect->getNom()
                .' '.$prospect->getPrenom());

            $this->addFlash('success', 'Votre demande a bien ete envoyée') ;

        }
        return $this->render('contact/index.html.twig', [
            'formulaire' => $form->createView()
        ]);
    }


}
