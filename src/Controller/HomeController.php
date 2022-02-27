<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Credenciales;


class HomeController extends AbstractController
{
    
    #[Route('/', name: 'app_homepage')]
    public function homePage()
    {
        return $this->render('index.html.twig');
    }

    #[Route('/login', name: 'app_login', methods: ["GET","POST"])]
    public function login(ManagerRegistry $doctrine)
    {
        $request = Request::createFromGlobals();
        $method = $request->getMethod();
        if($method == "GET"){
            return $this->render('login.html.twig');
        }else if($method == "POST"){
            $object = json_decode($request->request->get('dataJson'),true);
            if($object!=null){
                $usr = $object['usur'];
                $pws = $object['pswd'];
                $credencial = $doctrine->getRepository(Credenciales::class)->findOneBy(['usuario' => $usr,'password'=>$pws]);
                if($credencial!=null)
                    return new Response("Welcome!");
                else
                    return new Response("Credenciales invalidas");
            }
        }
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
        return $this->render('menu_search.html.twig',['tipo'=>$id]);
    }

    #[Route('/menu/update', name: 'app_menu_update')]
    public function m_update()
    {
        return $this->render('menu_update.html.twig');
    }

    #[Route('/menu/delete', name: 'app_menu_delete')]
    public function m_delete()
    {
        return $this->render('menu_delete.html.twig');
    }
    // #[Route('/{name}', name: 'app_notFound', methods: ["GET"])]
    // public function notFound($name)
    // {
    //     return new Response(
    //         "Usuario No autorizado " . "<br><button><a href='/'>Regresar</button>"
    //     );
    // }
}
