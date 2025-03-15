<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Repository\EtudiantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EtudiantController extends AbstractController
{
    #[Route('/etudiant/liste', name: 'app_etudiant_list',methods:['GET'])]
    public function liste(EtudiantRepository $repository)
    {
        
        return $this->render("etudiant/liste.html.twig",[
            "etudiants" => $repository->findAll()
        ]);
    }

    #[Route('/etudiant/add', name: 'app_etudiant_add',methods:['GET', 'POST'])]
    public function add(EntityManagerInterface $manager,Request $request): Response
    {
        $etudiant= new Etudiant();
        $form = $this->createForm(EtudiantType::class,$etudiant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $etudiant=$form->getData();
            $etudiant->setRoles(["ROLE_ETUDIANT"]);
            $manager->persist($etudiant);
            $manager->flush();
            $etudiant->setMatricule(substr($etudiant->getPrenom(),0,2)."0000".$etudiant->getId().substr($etudiant->getNom(),-2));
            $manager->persist($etudiant);
            $manager->flush();
            $this->addFlash(
                "success",
                "l'etudiant a ete ajoute avec succese"
            );
            return $this->redirectToRoute("app_etudiant_list");
        }

        return $this->render('etudiant/add.html.twig', [
            "form" => $form->createView()
        ]);
    }
}
