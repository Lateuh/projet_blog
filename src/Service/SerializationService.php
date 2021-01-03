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
                'id' => $meme->getId(),
                'title' => $meme->getTitre(),
                'slug' => $meme->getAlias(),
                'content' => $meme->getContent(),
                'published' => $meme->getPublished(),
            ];
        }

        return $serialized;
    }
    
}


?>