<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContenuActualiteController extends AbstractController
{
    #[Route('/contenu/actualite/{slug}', name: 'app_contenu_actualite')]
    public function index( string $slug): Response
    {
        return $this->render('contenu_actualite/index.html.twig', [
            'controller_name' => 'ContenuActualiteController',
        ]);
    }
}
