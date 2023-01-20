<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DelguerMaComptabiliteController extends AbstractController
{
    #[Route('/deleguer-ma-comptabilite', name: 'app_delguer_ma_comptabilite')]
    public function index(): Response
    {
        return $this->render('delguer_ma_comptabilite/index.html.twig', [
            'controller_name' => 'DelguerMaComptabiliteController',
        ]);
    }
}
