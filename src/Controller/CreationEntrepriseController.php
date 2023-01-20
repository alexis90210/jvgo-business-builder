<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreationEntrepriseController extends AbstractController
{
    #[Route('/creation-entreprise', name: 'app_creation_entreprise')]
    public function index(): Response
    {
        return $this->render('creation_entreprise/index.html.twig', [
            'controller_name' => 'CreationEntrepriseController',
        ]);
    }
}
