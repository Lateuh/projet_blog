<?php

namespace App\DataFixtures;

use App\Entity\User;
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
            $article
            ->setTitre($faker->safeColorName.' '.$faker->word)
            ->setPublished($faker->datetimeBetween('-12 months'))
            ->setContent($faker->paragraph);
            //->setAlias($t1.'-'.$t2);
            //$article->setImg($faker->imageUrl(200, 200));

            $manager->persist($article);
        }

        // user admin
        $user = new User();
        $user->setEmail('alexy.lefevre@gmail.com');
        $user->setPassword('$argon2i$v=19$m=65536,t=4,p=1$V1RGNWY0eXR1SldLU0ouZw$jUFOBuFi1gqtjIgmMzFh0Dgs8x8cnW3IIs2gK8EyYJ4');
        $user->setRoles(['ROLE_ADMIN']);

        $manager->persist($user);


        // users classiques
        $user = new User();
        $user->setEmail('matthieu.kowalczyk.um2@gmail.com');
        $user->setPassword('$argon2i$v=19$m=65536,t=4,p=1$V1RGNWY0eXR1SldLU0ouZw$jUFOBuFi1gqtjIgmMzFh0Dgs8x8cnW3IIs2gK8EyYJ4');

        $manager->persist($user);

        $user = new User();
        $user->setEmail('nathan.levy.um2@gmail.com');
        $user->setPassword('$argon2i$v=19$m=65536,t=4,p=1$V1RGNWY0eXR1SldLU0ouZw$jUFOBuFi1gqtjIgmMzFh0Dgs8x8cnW3IIs2gK8EyYJ4');

        $manager->persist($user);

        $manager->flush();
    }
}
