<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserFixtures extends Fixture
{
    private $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher){
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i <10 ; $i++) {
            $user= new User();
            $user->setNom('Nom '.$i);
            $user->setPrenom('Prenom '.$i);
            $user->setEmail('user'.$i.'@example.com');
            $user->setRoles(["Role_user"]);
           $user->setPlainPassword('password');
            $manager->persist($user);

        }


        $manager->flush();
    }
}
