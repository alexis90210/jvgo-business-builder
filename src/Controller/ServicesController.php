<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServicesController extends AbstractController
{
    #[Route('/services', name: 'app_services')]
    public function index(): Response
    {
        return $this->render('services/index.html.twig', [
            'controller_name' => 'ServicesController',
        ]);
    }

    #[Route('/services/comptabilite', name: 'app_services_comptabilite')]
    public function index2(): Response
    {
        return $this->render('services/comptabilite.html.twig', [
            'controller_name' => 'ServicesController',
        ]);
    }

    #[Route('/services/fiscalite', name: 'app_services_fiscalite')]
    public function index3(): Response
    {
        return $this->render('services/fiscalite.html.twig', [
            'controller_name' => 'ServicesController',
        ]);
    }

    #[Route('/services/creation-entreprise', name: 'app_services_ce')]
    public function index4(): Response
    {
        return $this->render('services/creation-entreprise.html.twig', [
            'controller_name' => 'ServicesController',
        ]);
    }
}
