<?php

namespace App\DataFixtures;

use App\Entity\Reserve;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $reserve = new Reserve();
        $reserve->setReserveTitle('Reserve 1');
        $manager->persist($reserve);

        $reserve = new Reserve();
        $reserve->setReserveTitle('Reserve 2');
        $manager->persist($reserve);

        $reserve = new Reserve();
        $reserve->setReserveTitle('Reserve 3');
        $manager->persist($reserve);

        $reserve = new Reserve();
        $reserve->setReserveTitle('Reserve 4');
        $manager->persist($reserve);

        $manager->flush();
    }
}
