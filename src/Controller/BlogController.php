<?php

namespace App\Controller;

use App\Entity\Blog;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(EntityManagerInterface $em): Response
    {

        $blog = $em->getRepository(Blog::class)->findAll();

        return $this->render('blog/index.html.twig', [
            'blogs' => $blog
        ]);
    }
}
