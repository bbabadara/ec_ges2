<?php

namespace App\DataFixtures;

use App\Entity\Filiere;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class FiliereFixtures extends Fixture
{
    
    public function load(ObjectManager $manager): void
    {
        $tabFiliere=["DWM", "DSI", "DCD", "DMCSI", "DAW", "DDA", "DGE"];
        for ($i=0; $i <5 ; $i++) {
            $filiere = new Filiere();
            $filiere->setLibelle($tabFiliere[$i]);
            $manager->persist($filiere);
        }

        $manager->flush();
    }
}
