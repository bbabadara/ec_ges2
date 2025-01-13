<?php
namespace App\DataFixtures;

use App\Entity\Etudiant;
use App\Entity\Classe;
use App\Entity\Filiere;
use App\Entity\Niveau;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ClasseFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Définir les niveaux et les filières
        $niveaux = ['L1', 'L2', 'L3'];
        $filiereNames = [
            'DWM' => 'Développement Web',
            'GL' => 'Génie Logiciel',
            'DN' => 'Design Numérique',
            'MDC' => 'Marketing Digital et Communication'
        ];

        // Créer les filières
        $filiereObjects = [];
        foreach ($filiereNames as $key => $name) {
            $filiere = new Filiere();
            $filiere->setNom($name);
            $manager->persist($filiere);
            $filiereObjects[$key] = $filiere;
        }

        // Créer les niveaux
        $niveauObjects = [];
        foreach ($niveaux as $niveauName) {
            $niveau = new Niveau();
            $niveau->setNom($niveauName);
            $manager->persist($niveau);
            $niveauObjects[$niveauName] = $niveau;
        }

        // Créer des classes avec des étudiants associés
        foreach ($filiereObjects as $filiereKey => $filiere) {
            foreach ($niveauObjects as $niveauKey => $niveau) {
                // Nom de la classe basé sur la combinaison filière et niveau
                $classeName = "{$niveauKey}{$filiereKey}";

                // Créer une nouvelle classe
                $classe = new Classe();
                $classe->setNom($classeName);
                $classe->setFiliere($filiere);
                $classe->setNiveau($niveau);

                // Nombre aléatoire d'étudiants à ajouter à cette classe
                $nbreEtudiant = rand(10, 20);

                for ($i = 0; $i < $nbreEtudiant; $i++) {
                    // Création d'un étudiant
                    $etudiant = new Etudiant();
                    $etudiant->setNomComplet("Etudiant-" . $classeName . "-" . $i);
                    $etudiant->setMatricule("MAT" . uniqid() . $i . $filiereKey);
                    $etudiant->setAdresse("Adresse-" . $classeName . "-" . $i);
                    $etudiant->setLogin(uniqid() . "@gmail.com");
                    $etudiant->setMdp("passer" . $i);

                    // Ajouter l'étudiant à la classe
                    $classe->addEtudiant($etudiant);

                    // Persister chaque étudiant
                    $manager->persist($etudiant);
                }

                // Persister la classe après avoir ajouté tous les étudiants
                $manager->persist($classe);
            }
        }

        // Sauvegarder les données en base de données
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            EtudiantFixtures::class,
        ];
    }
}
