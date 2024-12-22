<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Form\ClasseType;
use App\Repository\ClasseRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClasseController extends AbstractController
{
    #[Route('/classe/index', name: 'classe_index',methods:["GET"])]
    public function index(ClasseRepository $classeRepo): Response
    {
        $classes = $classeRepo->findAll();
        return $this->render('classe/index.html.twig', [
            'data' => $classes,
        ]);
    }
    #[Route('/classe/create', name: 'classe_create',methods:["GET","POST"])]
    public function create(ClasseRepository $classeRepo): Response
    {
        $classe=new Classe();
        $form=$this->createForm(ClasseType::class,$classe);
        return $this->render('classe/create.html.twig', [
            'formClasse' => $form->createView(),
        ]);
    }
}
