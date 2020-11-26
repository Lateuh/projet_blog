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
        for($i = 0;$i < 30;$i++)
        {
            $article = new Article();
            $article->setTitre($faker->safeColorName.' '.$faker->word)->setPublished($faker->datetimeBetween('-12 months'));
            $article->setContent($faker->paragraph);
            $article->setUrlAlias(1+$i);
            //$article->setImg($faker->imageUrl(200, 200));

            $manager->persist($article);
        }
        $manager->flush();
    }
}
