<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    
    


    /**
     * @Route("/creerpost", name="creer")
     */
    public function createArticle(EntityManagerInterface $entityManager):Response
    {
        //$entityManager = $this->getDoctrine()->getManager();

        $article = new Article();
        $article->setTitre('MASSI EST UN BOSS');
        $article->setPublished(new \Datetime());
        $article->setContent("Massinissa est mon ami, il est très gentil. Il recherche un stage en dev web pour pouvoir rester en France, sinon il doit rentrer dans son bled. Prenez le, c'est un boss !!!");
        $article->setUrlAlias('');
        //$article->setImg("massiPhoto");

        $entityManager->persist($article);

        $entityManager->flush();

        return new Response('Saved new article with titre : '.$article->getTitre());
    }
}
