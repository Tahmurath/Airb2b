<?php

namespace App\DataFixtures;

use App\Entity\Reserve;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
        //parent::__construct();
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = new User();
        $user->setEmail('test@test.con');
        $user->setRoles([
            'ROLE_ROOT','ROLE_ADMIN', 'ROLE_MANAGE'
        ]);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            '123456'
        );
        $user->setPassword($hashedPassword);

        $manager->persist($user);

        $reserve = new Reserve();
        $reserve->setReserveTitle('Reserve 1');
        $reserve->setCreatedBy($user);
        $manager->persist($reserve);

        $reserve = new Reserve();
        $reserve->setReserveTitle('Reserve 2');
        $reserve->setCreatedBy($user);
        $manager->persist($reserve);

        $manager->flush();
    }
}
