<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProcedureCreationEntrepriseController extends AbstractController
{
    #[Route('/procedure-creation-entreprise/{slug}', name: 'app_procedure_creation_entreprise')]
    public function index(string $slug): Response
    {
        return $this->render('procedure_creation_entreprise/index.html.twig', [
            'TypeEntreprise' => "{$slug}",
        ]);
    }
}
