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
        $manager->persist($reserve);
        $reserve = new Reserve();
        $manager->persist($reserve);
        $reserve = new Reserve();
        $manager->persist($reserve);
        $reserve = new Reserve();
        $manager->persist($reserve);

        $manager->flush();
    }
}
