<?php

namespace App\Controller;

use App\Entity\Filiere;
use App\Form\FiliereType;
use App\Repository\FiliereRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\RequestExceptionInterface;

class FiliereController extends AbstractController
{
    #[Route('/filiere/liste1', name: 'app_filiere_liste1',methods: ['GET'])]
    public function index(FiliereRepository $filiereRepository,PaginatorInterface $paginator, Request $request): Response
    {
        $filieress = $filiereRepository->findAll();
        $filieres = $paginator->paginate(
            $filieress, /* query NOT result */
            $request->query->getInt('page', 1), /* page number */
            5 /* limit per page */
        );        return $this->render('filiere/liste1.html.twig', [
            'filieres' => $filieres,
        ]);
    }
    // ajouter une filiere
    #[Route('/filiere/add', name: 'app_filiere_add', methods: ['GET', 'POST'])]
    public function add(FiliereRepository $filiereRepository,Request $request, EntityManagerInterface $manager): Response
    {
        $filiere=new Filiere();
        $form=$this->createForm(FiliereType::class,$filiere);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($filiere);
            $manager->flush();
            $this->addFlash('success','Filière ajoutée avec succès');
            return $this->redirectToRoute('app_filiere_liste1');
        }
        return $this->render('filiere/add.html.twig',[
            'form'=>$form->createView(),
        ]);
    }
    // modifier une filiere
    #[Route('/filiere/{id}/edit', name: 'app_filiere_edit', methods: ['GET', 'POST'])]
    public function edit(Filiere $filiere, Request $request, EntityManagerInterface $manager): Response
    {
        $form=$this->createForm(FiliereType::class,$filiere);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($filiere);
            $manager->flush();
            $this->addFlash('success','Filière modifiée avec succès');
            return $this->redirectToRoute('app_filiere_liste1');
        }
        return $this->render('filiere/add.html.twig',[
            'form'=>$form->createView(),
        ]);
    }
}
