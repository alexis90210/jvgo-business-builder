<?php

namespace App\Controller;

use App\Entity\Administration;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(): Response
    {
        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }

    #[Route('/login-admin', name: 'app_api_login' , methods:['POST'])]
    public function login( Request $request , ManagerRegistry $doctrine): Response
    {
        ini_set('display_errors', 1);
        
        $orm = $doctrine->getManager();

        $data = json_decode($request->getContent(), false);

        if ($data) {
            $admin = $orm->getRepository(Administration::class)->findOneBy([
                'Login' => $data->Login,
                'Password' => $data->Password
            ]);
    
            if ( !$admin) {
                return $this->json( [
                    'code' => 'error',
                    'message' => 'Identifiant ou mot de passe incorrect'
                ]);   
            }
    
            return $this->json( [
                'code' => 'success',
                'message' => 'Logged',
                'data' => $admin
            ]);
        } else {
            return $this->json( [
                'code' => 'error',
                'message' => 'DATA-RAW empty'
            ]);

        }


      
    }

}
