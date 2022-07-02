<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Comment;
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
        $this->createMany(Article::class, 30, function (Article $article) use ($manager) {
            $title = ucfirst($this->faker->words(random_int(1, 3), true));

            $article
                ->setTitle($title)
                ->setBody(ucfirst($this->faker->sentences(13, true)));

            if ($this->faker->boolean(60)) {
                $article->setPublishedAt($this->faker->dateTimeBetween('-100 days', '-1 days'));
            }

            $article->setAuthor($this->faker->randomElement(self::$authors))
                ->setLikeCount($this->faker->numberBetween(13, 27))
                ->setImageFilename($this->faker->randomElement(self::$images));

            $comment = (new Comment())
                ->setAuthorName('Bim')
                ->setContent($this->faker->paragraph)
                ->setArticle($article);

            $manager->persist($comment);
        });
    }
}
