<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Shooting;
use App\Entity\Photo;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class AdminDashboardController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    ) {
    }

    public function index(): Response
    {
        return $this->redirect(
            $this->adminUrlGenerator
                ->setController(UserCrudController::class)
                ->generateUrl()
        );
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Back');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        // CRUD Links
        yield MenuItem::linkToCrud('Users', 'fa fa-user', User::class);

        yield MenuItem::linkToCrud(
            'Shootings',
            'fa fa-camera',
            Shooting::class
        );

        yield MenuItem::linkToCrud(
            'Photos',
            'fa fa-image',
            Photo::class
        );
    }
}