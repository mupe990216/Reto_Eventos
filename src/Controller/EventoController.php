<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Evento;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

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
        return new Response("Registration successful!");
    }

    #[Route('/menu/update/{id}',name: 'db_update_evento')]
    public function updateEvento(ManagerRegistry $doctrine, int $id): Response{
        $cat = ['Concierto','Festival','Teatro','Deporte','Especial'];
        if($id>0 && $id<6){
            $db = $doctrine->getRepository(Evento::class);
            $eventos = $db->findBy(['categoria' => $id]);
            if($eventos==null){
                return $this->render('menu_list_update.html.twig',['cat'=>$cat[$id-1], 'opc' => 0]);
            }else{
                $encoders = [new XmlEncoder(), new JsonEncoder()];
                $normalizers = [new ObjectNormalizer()];
                $serializer = new Serializer($normalizers, $encoders);
                $jsonContent = $serializer->serialize($eventos, 'json');
                return $this->render('menu_list_update.html.twig',['cat'=>$cat[$id-1], 'opc' => $id, 'eventos' => $eventos, 'tam' => sizeof($eventos)]);
            }
        }else{
            return $this->redirectToRoute('app_login');
        }
    }

    #[Route('/menu/delete/{id}',name: 'db_delete_evento')]
    public function deleteEvento(ManagerRegistry $doctrine, int $id): Response{
        $cat = ['Concierto','Festival','Teatro','Deporte','Especial'];
        if($id>0 && $id<6){
            $db = $doctrine->getRepository(Evento::class);
            $eventos = $db->findBy(['categoria' => $id]);
            if($eventos==null){
                return $this->render('menu_list_delete.html.twig',['cat'=>$cat[$id-1], 'opc' => 0]);
            }else{
                return $this->render('menu_list_delete.html.twig',['cat'=>$cat[$id-1], 'opc' => $id, 'eventos' => $eventos, 'tam' => sizeof($eventos)]);
            }
        }else{
            return $this->redirectToRoute('app_login');
        }
    }

    
}
