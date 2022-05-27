<?php

namespace App\Controller;

use App\Entity\Depannage;
use App\Form\DepannageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepannageController extends AbstractController
{
    #[Route('/depannage', name: 'app_depannage')]
    public function index(Request $request,EntityManagerInterface $em): Response
    {
        $depannage = new Depannage();
        $form = $this->createForm(DepannageType::class,$depannage);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()){

            $em->persist($depannage);
            $em->flush();

        }

        return $this->render('depannage/index.html.twig', [
            'formDepannage' => $form->createView(),
        ]);
    }
}
