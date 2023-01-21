<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PolitiqueDeConfidentialiteController extends AbstractController
{
    #[Route('/politique-de-confidentialite', name: 'app_politique_de_confidentialite')]
    public function index(): Response
    {
        return $this->render('politique_de_confidentialite/index.html.twig', [
            'controller_name' => 'PolitiqueDeConfidentialiteController',
        ]);
    }
}
