<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Evento;

class EventoController extends AbstractController
{
    #[Route('/evento', name: 'db_create_evento')]
    public function createCredenciales(ManagerRegistry $doctrine): Response
    {
        $request = Request::createFromGlobals();
        $nombre = $request->request->get('nombre');
        $inmueble = $request->request->get('inmueble');
        $estado = $request->request->get('estado');
        $categoria = $request->request->get('categoria');
        
        $entityManager = $doctrine->getManager();
        $evento = new Evento();
        $evento->setNombre($nombre);
        $evento->setInmueble($inmueble);
        $evento->setEstado($estado);
        $evento->setCategoria($categoria);
        $entityManager->persist($evento);
        $entityManager->flush();
        return new Response("Evento registrado");
    }
}
