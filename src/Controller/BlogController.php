<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(ArticleRepository $articleRepo): Response
    {
        $articles = $articleRepo->findAll();

        $articlesTries = $articleRepo->findMostRecents();
        return $this->render('index_action/index.html.twig', [
            'nom_page' => 'Accueil',
            'liste_articles' => $articles,
            'liste_articles_tries' => $articlesTries
        ]);
    }


    /**
     * @Route("/post", name="postIdSB")
     */
    public function postIdSearchBar(Request $request, ArticleRepository $articleRepo): Response
    {
        $titre = $request->request->get('titre');
        $article = $articleRepo->findOneByTitre($titre);

        return $this->render('post_action/post.html.twig', [
            'nom_page' => 'Article',
            'article' => $article
        ]);
    }


    /**
     * @Route("/post/{alias}", name="postTitre")
     */
    public function postTitre(ArticleRepository $articleRepo, String $alias): Response
    {
        $article = $articleRepo->findOneByAlias($alias);

        return $this->render('post_action/post.html.twig', [
            'nom_page' => 'Article',
            'article' => $article
        ]);
    }

    
}
