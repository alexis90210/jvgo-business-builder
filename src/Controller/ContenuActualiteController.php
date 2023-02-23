<?php

namespace App\Controller;

use App\Entity\Blog;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContenuActualiteController extends AbstractController
{
    #[Route('/contenu/actualite/{slug}', name: 'app_contenu_actualite')]
    public function index( string $slug): Response
    {
        return $this->render('contenu_actualite/index.html.twig');
    }

    #[Route('/contenu/actualite/dynamic/{slug}', name: 'app_contenu_actualite_dyn')]
    public function index2( string $slug, EntityManagerInterface $em): Response
    {
        $blog = $em->getRepository(Blog::class)->find($slug);

        return $this->render('contenu_actualite/index2.html.twig', [
            'blog' => $blog,
        ]);
    }
}
