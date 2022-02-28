<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{

    #[Route('/', name: 'app_homepage')]
    public function homePage()
    {
        return $this->render('index.html.twig');
    }

    #[Route('/registration', name: 'app_registration')]
    public function registration()
    {
        return $this->render('create_count.html.twig');
    }

    #[Route('/menu', name: 'app_menu')]
    public function menu()
    {
        return $this->render('menu_inicio.html.twig');
    }

    #[Route('/menu/form', name: 'app_menu_form')]
    public function m_form()
    {
        return $this->render('menu_form.html.twig');
    }

    #[Route('/menu/search/{id}', name: 'app_menu_search')]
    public function m_search(int $id)
    {
        return $this->render('menu_search.html.twig', ['tipo' => $id]);
    }

}
