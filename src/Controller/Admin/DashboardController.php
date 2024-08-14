<?php
namespace App\Controller\Admin;

use App\Entity\Classes;
use App\Entity\Course;
use App\Entity\Payments;
use App\Entity\Schedules;
use App\Entity\Students;
use App\Entity\Teachers;
use App\Entity\User;
use App\Entity\Notification;
use App\Entity\Classe;
use App\Entity\Cours;
use App\Entity\Schedule;
use App\Entity\Teacher;
use App\Entity\Student;
use App\Entity\Payment;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;  
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Redirection vers un contrôleur CRUD ou une autre page d'administration
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('My School Admin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-users', User::class);
        yield MenuItem::linkToCrud('Notifications', 'fa fa-bell', Notification::class);
        yield MenuItem::linkToCrud('Classes', 'fa fa-chalkboard-teacher', Classes::class);
        yield MenuItem::linkToCrud('Cours', 'fa fa-book', Course::class);
        yield MenuItem::linkToCrud('Horaires', 'fa fa-calendar-alt', Schedules::class);
        yield MenuItem::linkToCrud('Enseignants', 'fa fa-chalkboard-teacher', Teachers::class);
        yield MenuItem::linkToCrud('Étudiants', 'fa fa-user-graduate', Students::class);
        yield MenuItem::linkToCrud('Paiements', 'fa fa-credit-card', Payments::class);
    }
}
