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
    #[Route('/etudiant', name: 'app_etudiant')]
    public function index(): Response
    {
        return $this->render('etudiant/index.html.twig', [
            'controller_name' => 'EtudiantController',
        ]);
    }

    #[Route('/etudiant/create', name: 'etudiant_create',methods:["GET","POST"])]
    public function create(EtudiantRepository $etudiantRepo): Response
    {
        $etudiant=new Etudiant();
        $form=$this->createForm(EtudiantType::class,$etudiant);
        return $this->render('etudiant/create.html.twig', [
            'formEtudiant' => $form->createView(),
        ]);
        
    }
}
