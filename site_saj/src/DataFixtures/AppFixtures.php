<?php

namespace App\DataFixtures;

use App\Entity\Prospect;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i<10 ; $i++)
        {
            $prospect = new Prospect();
            $prospect->setNom('prospect'.$i)
            ->setPrenom('prospect')
            ->setEmail('prospect@.com'.$i)
            ->setTelephone("046987569")
            ->setDemandeDeDevis("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.");
            $manager->persist($prospect);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
