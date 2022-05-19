<?php

namespace App\Controller\Admin;

use App\Entity\Prospect;
use App\Form\DemandeProspectType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    // Ici je cree une injection de dependance
    private AdminUrlGenerator $adminUrlGenerator;

    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;

    }

    #[Route('/admin', name: 'admin')]
    #[IsGrantes(['ROLE_ADMIN'])]
    public function index(): Response
    {
        // je genere un url grace admin generateur qui va s'occuper de generer la route correspondante a l'affichage
        //des prospects
        $url = $this->adminUrlGenerator
            ->setController(ProspectCrudController::class)
            ->generateUrl();
        // return parent::index();

        // la je redirige vers cette url qui a ete genere
        return $this->redirect($url);

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        //

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Saj Fermetures');
    }

    public function configureMenuItems(): iterable
    {
        return [
        MenuItem::subMenu('clients', 'fa fa-envelope')->setSubItems([
            MenuItem::linkToCrud('Prospect', 'fa fa-tags', Prospect::class)->setAction(Crud::PAGE_EDIT),

        ]),
           ];
        // ...

        // Ici je configure mon menu.Grace a la methode yield qui me permet de retourner de multiples elements comme un tableau
        // c'est un geneteur

   //    yield MenuItem::section('Demande de devis', 'fa fa-home');
//        yield MenuItem::section('Action','fas fa-bars')->setSubitems([
//            MenuItem::linkToCrud('add pro','fas fa-plus',Prospect::class)
//        ]);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
