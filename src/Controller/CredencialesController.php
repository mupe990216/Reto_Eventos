<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Credenciales;
use Exception;

class CredencialesController extends AbstractController
{

    #[Route('/login', name: 'app_login', methods: ["GET", "POST"])]
    public function login(ManagerRegistry $doctrine)
    {
        $request = Request::createFromGlobals();
        $method = $request->getMethod();
        if ($method == "GET") {
            return $this->render('login.html.twig');
        } else if ($method == "POST") {
            $object = json_decode($request->request->get('dataJson'), true);
            if ($object != null) {
                $usr = $object['usur'];
                $pws = $object['pswd'];
                $credencial = $doctrine->getRepository(Credenciales::class)->findOneBy(['usuario' => $usr, 'password' => $pws]);
                if ($credencial != null)
                    return new Response("Welcome!");
                else
                    return new Response("Credenciales invalidas");
            }
        }
    }


    #[Route('/credenciales', name: 'db_create_credenciales')]
    public function createCredenciales(ManagerRegistry $doctrine): Response
    {
        try {
            $request = Request::createFromGlobals();
            $object = json_decode($request->request->get('dataJson'),true);
            if($object!=null){
                $usr = $object['usur'];
                $pwd = $object['pswd'];
                $credencial = $doctrine->getRepository(Credenciales::class)->findOneBy(['usuario' => $usr]);
                if($credencial==null){
                    $entityManager = $doctrine->getManager();
                    $credencial = new Credenciales();
                    $credencial->setUsuario($usr);
                    $credencial->setPassword($pwd);
                    $entityManager->persist($credencial);
                    $entityManager->flush();
                    return new Response("Registration successful!");
                }else{
                    return new Response("Existing user");
                }//end if
            }//end if
        } catch (Exception $e) {
            return new Response($e);
        }//end try
    }

    #[Route('/credenciales/{usr}', name: 'db_show_credencial')]
    public function selectCredencial(ManagerRegistry $doctrine, string $usr): Response
    {
        try {
            $credencial = $doctrine->getRepository(Credenciales::class)->findOneBy(['usuario' => $usr]);
            if (!$credencial) {
                return new Response('No credential found for user ' . $usr);
            }
            return new Response('Check out this great product: ' . $credencial->getUsuario() . $credencial->getPassword());
        } catch (Exception $e) {
            return new Response($e);
        }
    }

    #[Route('/credenciales/edit/{usr}', name: 'db_update_credencial')]
    public function updateCredencial(ManagerRegistry $doctrine, string $usr): Response
    {
        try {
            $entityManager = $doctrine->getManager();
            $credencial = $entityManager->getRepository(Credenciales::class)->findOneBy(['usuario' => $usr]);
            if (!$credencial) {
                return new Response('No credential found for user ' . $usr);
            }
            $credencial->setUsuario($usr . "0");
            $entityManager->flush();
            return $this->redirectToRoute('db_show_credencial', [
                'usr' => $credencial->getUsuario()
            ]);
        } catch (Exception $e) {
            return new Response($e);
        }
    }

    #[Route('/credenciales/delete/{usr}', name: 'db_delete_credencial')]
    public function deleteCredencial(ManagerRegistry $doctrine, string $usr): Response
    {
        try{
            $entityManager = $doctrine->getManager();
            $credencial = $entityManager->getRepository(Credenciales::class)->findOneBy(['usuario' => $usr]);
            if (!$credencial) {
                return new Response('No credential found for user ' . $usr);
            }
            $entityManager->remove($credencial);
            $entityManager->flush();
            return $this->redirectToRoute('db_show_credencial', [
                'usr' => $credencial->getUsuario()
            ]);
        }catch(Exception $e){
            return new Response($e);
        }
    }
}
