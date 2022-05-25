<?php

namespace App\Controller;

use App\Entity\Prospect;
use App\Form\DemandeProspectType;
use App\Services\MailerService;
use App\Services\PdfService;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
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

            $service->sendMail("Demande", "" . '' . "Vous avez une nouvelle demande de devis de " . ' ' . $prospect->getNom()
                . ' ' . $prospect->getPrenom());

            $this->addFlash('success', 'Votre demande a bien ete envoyée');

        }
        return $this->render('contact/index.html.twig', [
            'formulaire' => $form->createView()
        ]);
    }

//    /**
//     * @Route ("pdf", name:'prospect_pdf')
//     */
//    public function genPdfProspect(Prospect $prospect  , PdfService $pdfService)
//    {
//
//        $html = $this->renderView('contact/pdf.html.twig', ['prospect' => $prospect]);
//        $pdfService->showPdfFile($html) ;
//
//    }

    #[Route('/pdf/{id}', name: 'pdf')]
    public function pdfClient(Prospect $prospect): Response
    {
        // Création d' un objet ave les différentes options
        $pdfOptions = new Options();
        $pdfOptions->setDefaultFont('Arial');
        $pdfOptions->setIsRemoteEnabled(true);
        $dompdf = new Dompdf($pdfOptions);

        // Affiche la vue
        $html = $this->renderView('contact/pdf.html.twig', [
            'prospect' => $prospect,
        ]);

//        // Les caractéristiques du PDF
//        $dompdf->loadHtml($html);
//        $dompdf->setPaper('A4');
//        $dompdf->render();
//        $dompdf->stream("Facture");
//
//        return new Response('', 200, [
//            'Content-Type' => 'contact/pdf.html.twig',
//        ]);


    }
}
