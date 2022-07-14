<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends BaseFixtures
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher
    ) {
    }

    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(User::class, 10, function (User $user) {
            $user
                ->setEmail($this->faker->email)
                ->setFirstName($this->faker->firstName)
                ->setPassword(
                    $this->userPasswordHasher->hashPassword(
                        $user,
                        '123456'
                    )
                );
        });
    }
}
