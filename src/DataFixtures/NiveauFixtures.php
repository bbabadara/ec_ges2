<?php

namespace App\DataFixtures;

use App\Entity\Niveau;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class NiveauFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $tabNiveau=["Licence 1","Licence 2","Licence 3","Master 1","Master 2"];
        for ($i=0; $i <5 ; $i++) {
            $niveau = new Niveau();
            $niveau->setLibelle($tabNiveau[$i]);
            $manager->persist($niveau);
        }

        $manager->flush();
    }
}
