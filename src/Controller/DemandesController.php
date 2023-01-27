<?php

namespace App\Controller;

use App\Entity\Demandes;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemandesController extends AbstractController
{
    #[Route('/dashboard/demandes/{type}', name: 'app_demandes')]
    public function index(string $type , ManagerRegistry $doctrine, Request $request): Response
    {
        $session = $request->getSession();

        $authed = $session->get('auth');

        // if ( $authed != 1) {
        //     return $this->redirect("/login");
        // }


        $type = (int) $type;

        $orm = $doctrine->getManager();

        if ( $type == 1 || $type == 2) {

            $demandes= $orm->getRepository(Demandes::class)->findBy(
                [
                    "EntrepriseOrCompta" => $type
                ]
            );

         } else {
            die('Access refused');
         }

        return $this->render('demandes/index.html.twig', [
            'switcher' => $type,
            'demandes' => array_reverse($demandes),
            'count' => count( $demandes ),
        ]);


    }
}
