<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
        for($i = 0;$i < 20;$i++)
        {
            $article = new Article();
            $article->setTitre($faker->safeColorName.' '.$faker->word)->setPublished($faker->datetimeBetween('-6 months'));
            $article->setContent($faker->paragraph);
            $article->setUrlAlias($faker->url);
            $article->setImg($faker->imageUrl(200, 200));

            $manager->persist($article);
        }
        $manager->flush();
    }
}
