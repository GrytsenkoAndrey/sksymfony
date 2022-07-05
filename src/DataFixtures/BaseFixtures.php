<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

abstract class BaseFixtures extends Fixture
{
    protected Generator $faker;
    protected ObjectManager $manager;
    private $referenceIndexes = [];

    public function load(ObjectManager $manager): void
    {
        $this->faker = Factory::create();
        $this->manager = $manager;

        $this->loadData($this->manager);
    }

    abstract public function loadData(ObjectManager $manager);

    protected function create(string $className, callable $factory): mixed
    {
        $entity = new $className;
        $factory($entity);

        $this->manager->persist($entity);

        return $entity;
    }

    protected function createMany(string $className, int $count, callable $factory)
    {
        for ($i = 0; $i < $count; $i++) {
            $entity = $this->create($className, $factory);
            $this->addReference("$className|$i", $entity);
        }
        $this->manager->flush();
    }

    protected function getRandomReference(string $className)
    {
        if (! isset($this->referenceIndexes[$className])) {
            $this->referenceIndexes[$className] = [];

            foreach ($this->referenceRepository->getReferences() as $key => $reference) {
                if (strpos($key, $className . '|') === 0) {
                    $this->referenceIndexes[$className][] = $key;
                }
            }
        }

        if (empty($this->referenceIndexes[$className])) {
            throw new \Exception('Not found class by link ' . $className);
        }

        return $this->getReference($this->faker->randomElement($this->referenceIndexes[$className]));
    }
}
