<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Persistence\ObjectManager;

class TagFixture extends BaseFixtures
{
    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(Tag::class, 30, function (Tag $tag) {
            $tag->setName($this->faker->realText(15));
        });

        $manager->flush();
    }
}
