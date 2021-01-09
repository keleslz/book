<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use App\Entity\Conference;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Livre d\'or');
    }

    public function configureMenuItems(): iterable
    {   
        return [
            yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home'),
            MenuItem::linktoDashboard('Conferences'), yield MenuItem::linkToCrud('Conferences', 'far fa-comments', Conference::class),
            yield MenuItem::linktoRoute('+ de details /conf', 'far fa-comments', 'conferences'),
            MenuItem::linktoDashboard('Commentaires'), yield MenuItem::linkToCrud('Commentaires', 'far fa-eye', Comment::class),
        ];
    }
}
