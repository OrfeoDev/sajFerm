<?php

namespace App\Controller;

use App\Entity\Prospect;
use App\Form\DemandeProspectType;
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
    protected $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $em, MailerInterface $mailer): Response
    {
        $prospect = new Prospect();
        $form = $this->createForm(DemandeProspectType::class, $prospect);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $em->persist($prospect);
            $em->flush();

            $email = new Email();
            $email->from(new Address($prospect->getEmail(),$prospect->getNom()))
                ->to("@gmail.com")
                ->text($prospect->getDemandeDeDevis())
                ->html('<p>See Twig integration for better HTML integration!</p>');
                ;
            $this->mailer->send($email);
            $this->addFlash('success', 'Votre demande a bien ete envoyé');
        }
        return $this->render('contact/index.html.twig', [
            'formulaire' => $form->createView()
        ]);
    }

    public function envoiDeMail()
    {

    }
}
