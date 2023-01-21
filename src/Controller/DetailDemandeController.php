<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DetailDemandeController extends AbstractController
{
    #[Route('/dashboard/detail-demande/{slug}', name: 'app_detail_demande')]
    public function index( string $slug ): Response
    {
        return $this->render('detail_demande/index.html.twig', [
            'controller_name' => 'DetailDemandeController',
        ]);
    }
}
