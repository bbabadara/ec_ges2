<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use App\Repository\ClasseRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EtudiantFixtures extends Fixture 
{
    // injection de depenence pour que a chaque creation d'etudiant on lui asssocie une classe
    
    public function __construct( private  ClasseRepository $classeRepository){
        
    }

    public function load(ObjectManager $manager): void
    {
        $classes=$this->classeRepository->findAll();
        foreach ($classes as $key => $classe) {
            $nbreEtudiant=rand(10,20);
        for ($i=0; $i <=$nbreEtudiant ; $i++) {
            $etudiant=new Etudiant();
            $etudiant
                ->setNomComplet("Etudiant-$key-$i")
                ->setMatricule("MAT".uniqid().$i.$key)
                ->setAdresse("Adresse-".$key."-".$i)
                ->setLogin(uniqid()."@gmail.com")
                ->setMdp("passer".$i)
                ->setClasse($classe);
            //persistance des données en base de données permet d'ajouter la reque au niveau du cahe
            $manager->persist($etudiant);
        }
        }
        //flush signifi que les requettes seront executer en mm temps
        $manager->flush();
    }
}
