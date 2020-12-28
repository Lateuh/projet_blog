<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostActionController extends AbstractController
{
    /**
     * @Route("/post/{url}", name="postId")
     */
    public function postId(ArticleRepository $articleRepo, int $url): Response
    {
        $article = $articleRepo->findOneByUrl($url);

        return $this->render('post_action/post.html.twig', [
            'nom_page' => 'Article n°',
            'id' => $url,
            'article' => $article
        ]);
    }

    /**
     * @Route("/post", name="postIdSB")
     */
    public function postIdSearchBar(Request $request, ArticleRepository $articleRepo): Response
    {
        $url = (int) $request->request->get('url');
        $article = $articleRepo->findOneByUrl($url);

        return $this->render('post_action/post.html.twig', [
            'nom_page' => 'Article n°',
            'id' => $url,
            'article' => $article
            
        ]);
    }

    /**
     * @Route("/post/{url}", name="postUrl")
     */
    /*public function postUrl(ArticleRepository $articleRepo, String $url): Response
    {
        $article = $articleRepo->findOneByUrl($url);

        return $this->render('post_action/post.html.twig', [
            'nom_page' => 'Article n°',
            'id' => $article->getId(),
            'article' => $article
        ]);
    }*/


}
