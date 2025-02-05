<?php

namespace App\Controller\User;

use App\Entity\Business;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/dashboard', routeName: 'dashboard')]
class DashboardUserController extends AbstractDashboardController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // 1.1) If you have enabled the "pretty URLs" feature:
        // return $this->redirectToRoute('admin_user_index');
        //
        // 1.2) Same example but using the "ugly URLs" that were used in previous EasyAdmin versions:
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirectToRoute('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //

        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Symfony Manager')
            ->disableDarkMode();
    }

    public function configureMenuItems(): iterable
    {
        $user = $this->security->getUser();

        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        $user = $this->security->getUser();

        if ($user instanceof User) {
            // Maintenant vous pouvez appeler getId() en toute sécurité
        } else {
            // L'utilisateur n'est pas une instance de User, gérer l'erreur
            throw new AccessDeniedException('User is not authenticated');
        }

        yield MenuItem::linkToCrud('Edit Your Profile', 'fa fa-user', User::class)
            ->setAction('edit')
            ->setEntityId($user->getId());

        if ('ROLE_BUSINESS' || 'ROLE_ADMIN' === $this->getUser()->getRoles()[0]) {
            yield MenuItem::linkToCrud('Business', 'fa fa-building', Business::class);
        }
    }
}
