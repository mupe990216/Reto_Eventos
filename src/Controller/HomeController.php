<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/",name="pagina_principal")
     */
    public function homePage(){
        $number = random_int(0,100);
        return new Response(
            "Hola Mundo Con Symfony UwUr ".$number.
            "<br><button><a href='./Elias'>Saludar</button>"
        );
    }

    /**
     * @Route("/{nombre}",name="saludador")
     */
    public function saludar($nombre){
        if($nombre == "Elias"){
            return new Response(
                "<h1> Hola ".$nombre." UwU</h1>".
                "<br><button><a href='/'>Regresar</button>"
            );
        }else{
            return new Response(
                "Usuario No autorizado "."<br><button><a href='/'>Regresar</button>"
            );
        }

    }
}