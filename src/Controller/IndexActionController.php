<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexActionController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(ArticleRepository $articleRepo): Response
    {
        /*$articles = $articleRepo->findAll();

        $articlesTries = $articleRepo->findMostRecents();*/
        return $this->render('index_action/index.html.twig', [
            'nom_page' => 'Accueil'/*,
            'liste_articles' => $articles,
            'liste_articles_tries' => $articlesTries*/
        ]);
    }


}
