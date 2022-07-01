<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends BaseFixtures
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

    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(Article::class, 30, function (Article $article)  {
            $title = ucfirst($this->faker->words(random_int(1, 3), true));
            $slug = str_replace(' ', '-', strtolower($title));

            $article
                ->setTitle($title)
                ->setSlug($slug)
                ->setBody(ucfirst($this->faker->sentences(13, true)));

            if ($this->faker->boolean(60)) {
                $article->setPublishedAt(new \DateTimeImmutable(sprintf('-%d days', rand(0, 30))));
            }

            $article->setAuthor($this->faker->randomElement(self::$authors))
                ->setLikeCount($this->faker->numberBetween(13, 27))
                ->setImageFilename($this->faker->randomElement(self::$images));
        });
    }
}
