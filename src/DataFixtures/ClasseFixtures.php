<?php

namespace App\DataFixtures;
use App\Entity\Etudiant;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ClasseFixtures extends Fixture implements DependentFixtureInterface //implement DependentFixtureInterface pour changer l'odre de l'execusion
{
    public function load(ObjectManager $manager): void
    {
        $datas=["L1DWM", "L2DWM", "L3DWM", "L1MD", "L2MD", "L3MD"];
        foreach ($datas as $key => $value) {
            $classe = new \App\Entity\Classe();
            $classe->setNom($value);
            $nbreEtudiant=rand(10,20);
            for ($i=0; $i <=$nbreEtudiant ; $i++) {
                $etudiant=new Etudiant();
                $etudiant->setNomComplet("Etudiant-$key-$i");
                $etudiant->setMatricule("MAT".uniqid().$i.$key);
                $etudiant->setAdresse("Adresse-".$key."-".$i);
                $etudiant->setLogin(uniqid()."@gmail.com");
                $etudiant->setMdp("passer".$i);
                $classe->addEtudiant($etudiant);
            }
            $manager->persist($classe);
        }

        $manager->flush();
    }
    // definition de l'ordre d'execution des fixtures etudiant viendra avant classe
    public function getDependencies(): array
    {
        return [
            EtudiantFixtures::class,
        ];
    }
    
}
