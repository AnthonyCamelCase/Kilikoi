<?php

namespace App\Controller\Admin;

use App\Entity\Commentaire;
use App\Entity\ListeDeLecture;
use App\Entity\Livre;
use App\Entity\Saga;
use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class DashboardController extends AbstractDashboardController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/gestion", name="gestion")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
        #return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Kilikoi');
    }

    public function configureMenuItems(): iterable
    {

        yield MenuItem::linkToCrud('Utilisateur', 'fa fa-user', Utilisateur::class);
        yield MenuItem::linkToCrud('Liste De Lecture', 'fa fa-list', ListeDeLecture::class);
        yield MenuItem::linkToCrud('Livre', 'fa fa-book', Livre::class);
        yield MenuItem::linkToCrud('Saga', 'fa fa-key', Saga::class);
        yield MenuItem::linkToCrud('Commentaire', 'fa fa-list', Commentaire::class);

    }
}