<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        return $this->render('blog/index.html.twig', [
            'nom_page' => 'Accueil'
        ]);
    }



    /**
     * @Route("/post/{id}", name="post")
     */
    public function post(int $id): Response
    {
        return $this->render('blog/post.html.twig', [
            'id' => $id
        ]);
    }
}
