<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    
    #[Route('/', name: 'app_homepage')]
    public function homePage()
    {
        return $this->render('login.html.twig');
    }

    #[Route('/login', name: 'app_login')]
    public function login()
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
                //
                return new Response("Welcome!");
            }else{
                return new Response("Credenciales invalidas".$request->getMethod());
            }//end if
        }else{
            return new Response("Method not support");
        }//end if
    }

    #[Route('/registration', name: 'app_registration', methods: ["GET"])]
    public function registration()
    {
        return $this->render('create_count.html.twig');
    }

    #[Route('/menu', name: 'app_menu', methods: ["GET"])]
    public function menu()
    {
        return new Response(
            "Menu Inicio " . "<br><button><a href='/'>Regresar</button>"
        );
    }

    // #[Route('/{name}', name: 'app_notFound', methods: ["GET"])]
    // public function notFound($name)
    // {
    //     return new Response(
    //         "Usuario No autorizado " . "<br><button><a href='/'>Regresar</button>"
    //     );
    // }
}
