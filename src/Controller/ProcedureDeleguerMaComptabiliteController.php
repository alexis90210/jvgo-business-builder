<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProcedureDeleguerMaComptabiliteController extends AbstractController
{
    #[Route('/procedure-deleguer-ma-comptabilite/{typeUser}/{typePack}', name: 'app_procedure_deleguer_ma_comptabilite')]
    public function index(string $typeUser , string $typePack): Response
    {
        return $this->render('procedure_deleguer_ma_comptabilite/index.html.twig', [
            'typeUser' => $typeUser,
            'typePack' => $typePack,
            'UserController' => $typeUser == 'Independant' ? 1 : 2
        ]);
    }
}
