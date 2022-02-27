<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Credenciales;
use App\Repository\CredencialesRepository;
use Exception;

class CredencialesController extends AbstractController
{

    #[Route('/credenciales', name: 'db_create_credenciales')]
    public function createCredenciales(ManagerRegistry $doctrine): Response
    {
        try {
            $entityManager = $doctrine->getManager();
            $credencial = new Credenciales();
            $credencial->setUsuario("hola");
            $credencial->setPassword("1234");
            $entityManager->persist($credencial);
            $entityManager->flush();
            return new Response('Saved new product with id' . $credencial->getId());
        } catch (Exception $e) {
            return new Response($e);
        }
    }

    #[Route('/credenciales/{usr}', name: 'db_show_credencial')]
    public function selectCredencial(ManagerRegistry $doctrine, string $usr): Response
    {
        try {
            $credencial = $doctrine->getRepository(Credenciales::class)->findOneBy(['usuario' => $usr]);
            if (!$credencial) {
                // throw $this->createNotFoundException(
                //     'No credential found for user ' . $usr
                // );
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
                // throw $this->createNotFoundException(
                //     'No credential found for user ' . $usr
                // );
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
                // throw $this->createNotFoundException(
                //     'No credential found for user ' . $usr
                // );
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
