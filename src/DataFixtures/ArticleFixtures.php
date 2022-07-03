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

            for ($i = 0, $cnt = random_int(2, 7); $i < $cnt; $i++) {
                $this->addComment($article, $manager);
            }
        });
    }

    private function addComment(Article $article, ObjectManager $manager): void
    {
        $comment = (new Comment())
            ->setAuthorName($this->faker->randomElement(self::$authors))
            ->setContent($this->faker->paragraph)
            ->setCreatedAt($this->faker->dateTimeBetween('-20 hours'))
            ->setArticle($article);

        if ($this->faker->boolean(50)) {
            $comment->setDeletedAt($this->faker->dateTimeThisMonth);
        }

        $manager->persist($comment);
    }
}
