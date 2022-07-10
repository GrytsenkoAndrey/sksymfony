<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Tag;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends BaseFixtures implements DependentFixtureInterface
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

            /** @var Tag[] $tags */
            $tags = [];
            for ($i = 0, $cnt = random_int(0, 5); $i < $cnt; $i++) {
                $tags[] = $this->getRandomReference(Tag::class);
            }
            foreach ($tags as $tag) {
                $article->addTag($tag);
            }
        });
    }

    public function getDependencies()
    {
        return [
            TagFixture::class
        ];
    }
}
