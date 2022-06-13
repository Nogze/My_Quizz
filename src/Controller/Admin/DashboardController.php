<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use App\Controller\Admin\UsersCrudController;
use App\Controller\Admin\QuestionsCrudController;
use App\Controller\Admin\QuizzCrudController;
use App\Controller\Admin\AnswersCrudController;
use App\Entity\Users;
use App\Entity\Quizz;
use App\Entity\Answers;
use App\Entity\Questions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Menu\SubMenuItem;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        $url = $this->adminUrlGenerator
        ->setController(UsersCrudController::class)
        ->generateUrl();
        return $this->redirect($url);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('My Quizz');
    }

    public function configureMenuItems(): iterable
    {     
        yield MenuItem::section('Users');

        yield MenuItem::linkToCrud('Users', 'fas fa-user', Users::class);

        yield MenuItem::section('Quizz');
        yield MenuItem::subMenu("Quizz", 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud('quizz', 'fas fa-plus', Quizz::class),
            MenuItem::linkToCrud('Questions', 'fas fa-plus', Questions::class),
            MenuItem::linkToCrud('Answers', 'fas fa-plus', Answers::class)
        ]);
    }
}
