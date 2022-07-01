<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ArticleFixtures extends Fixture
{
    private static $authors = [
        'Bim',
        'Vasya',
        'Black',
        'Dickson'
    ];

    private static $images = [
        'simon-chicken.jpg',
        'simon-hey.png'
    ];

    public function load(ObjectManager $manager): void
    {
        for ($cnt = 30, $i = 0; $i < $cnt; $i++) {
            $article = new Article();

            $faker = Factory::create();
            $title = ucfirst($faker->words(random_int(1, 3), true));
            $slug = str_replace(' ', '-', strtolower($title));

            $article
                ->setTitle($title)
                ->setSlug($slug)
                ->setBody(ucfirst($faker->sentences(13, true)));

            if ($faker->boolean(60)) {
                $article->setPublishedAt(new \DateTimeImmutable(sprintf('-%d days', rand(0, 30))));
            }

            $article->setAuthor($faker->randomElement(self::$authors))
                ->setLikeCount($faker->numberBetween(13, 27))
                ->setImageFilename($faker->randomElement(self::$images));

            $manager->persist($article);
        }

        $manager->flush();
    }
}
