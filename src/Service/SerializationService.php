<?php

namespace App\Service;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

class SerializationService  
{

    public function getSerialized(EntityManagerInterface $entityManagerInterface)
    {
        $articles = $entityManagerInterface->getRepository(Article::class)->findMostRecents(5);

        $serializedArticles = [];

        foreach ($articles as $article ) {
            $serialized []= [
                'id' => $article->getId(),
                'title' => $article->getTitre(),
                'slug' => $article->getAlias(),
                'content' => $article->getContent(),
                'published' => $article->getPublished(),
            ];
        }

        return $serialized;
    }
    
}


?>