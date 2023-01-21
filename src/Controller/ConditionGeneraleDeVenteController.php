<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConditionGeneraleDeVenteController extends AbstractController
{
    #[Route('/condition-generale-de-vente', name: 'app_condition_generale_de_vente')]
    public function index(): Response
    {
        return $this->render('condition_generale_de_vente/index.html.twig', [
            'controller_name' => 'ConditionGeneraleDeVenteController',
        ]);
    }
}
