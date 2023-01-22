<?php

namespace App\Controller;

use App\Entity\Demandes;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index( ManagerRegistry $doctrine ): Response
    {
        $orm = $doctrine->getManager();

        $demandes_entreprise = $orm->getRepository(Demandes::class)->findBy(
            [
                "EntrepriseOrCompta" => 1 // Entreprise
            ]
        );

        $demandes_compta = $orm->getRepository(Demandes::class)->findBy(
            [
                "EntrepriseOrCompta" => 2 // Comptabilite
            ]
        );

        return $this->render('dashboard/index.html.twig', [
            'entreprise' => $demandes_entreprise,
            'comptabilite' => $demandes_compta,
            'count_entreprise' => count( $demandes_entreprise ),
            'count_comptabilite' => count( $demandes_compta )
        ]);
    }
}
