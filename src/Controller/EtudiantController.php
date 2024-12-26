<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Repository\EtudiantRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EtudiantController extends AbstractController
{
    #[Route('/etudiant/index', name: 'etudiant_index',methods:["GET"])]
    public function index(EtudiantRepository $etudiantRepo): Response
    {
        $etudiants = $etudiantRepo->findAll();
        // dd($etudiants);
        return $this->render('etudiant/index.html.twig', [
            'controller_name' => 'EtudiantController',
            'data' => $etudiants,
        ]);
    }
  
    #[Route('/etudiant/create', name: 'etudiant_create',methods:["GET","POST"])]
    public function create(EtudiantRepository $etudiantRepo): Response
    {
        $etudiant=new Etudiant();
        $form=$this->createForm(EtudiantType::class,$etudiant);
        return $this->render('etudiant/createtest.html.twig', [
            'formEtudiant' => $form->createView(),
        ]);
        
    }
}
