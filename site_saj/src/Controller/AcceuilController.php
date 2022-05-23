<?php

namespace App\Controller;

use App\Entity\Prospect;
use App\Form\DemandeProspectType;
use Doctrine\ORM\EntityManagerInterface;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AcceuilController extends AbstractController
{
    #[Route('/', name: 'app_acceuil')]
    public function index(): Response
    {
        return $this->render('acceuil/index.html.twig', [
            'controller_name' => 'AcceuilController',
        ]);
    }
//    /**
//     * @Route ("/contact" , name: "app_contact)
//     */
//    public function contact(Request $request,EntityManagerInterface $em)
//    {
////        $prospect = new Prospect();
////
////        $form=$this->createForm(DemandeProspectType::class,$prospect );
//
//
//        return $this->render('acceuil/contact.html.twig',[
//            //'formulaire'=>$form->createView()
//        ]);
//    }
}
