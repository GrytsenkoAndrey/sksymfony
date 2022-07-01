<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($cnt = 10, $i = 0; $i < $cnt; $i++) {
            $article = new Article();

            $faker = Factory::create();
            $title = ucfirst($faker->words(random_int(1, 3), true));
            $slug = str_replace(' ', '-', strtolower($title));

            $article
                ->setTitle($title)
                ->setSlug($slug)
                ->setBody(ucfirst($faker->sentences(10, true)));

            if (rand(1, 10) > 4) {
                $article->setPublishedAt(new \DateTimeImmutable(sprintf('-%d days', rand(0, 30))));
            }

            $article->setAuthor($faker->name)
                ->setLikeCount(random_int(1, 100))
                ->setImageFilename('simon-hey.png');

            $manager->persist($article);
        }

        $manager->flush();
    }
}
