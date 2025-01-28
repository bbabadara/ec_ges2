<?php

namespace App\Controller;

use App\Entity\Niveau;
use App\Form\NiveauType;
use App\Repository\NiveauRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NiveauController extends AbstractController
{
    #[Route('/niveau/liste1',  name: 'app_niveau_liste1',methods: ['GET'])]
    public function index(NiveauRepository $niveauRepository,PaginatorInterface $paginator,Request $request): Response
    {
        $niveaux = $niveauRepository->findAll();
        $pagination = $paginator->paginate(
            $niveaux,
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('niveau/liste1.html.twig', [
            'niveaux' => $pagination,
        ]);

      
    }

    //ajout niveau
    #[Route('/niveau/add', name: 'app_niveau_add', methods: ['GET', 'POST'])]
    public function add(NiveauRepository $niveauRepository,Request $request, EntityManagerInterface $manager): Response
    {
        $niveau = new Niveau();
        $form = $this->createForm(NiveauType::class, $niveau);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($niveau);
            $manager->flush();
            return $this->redirectToRoute('app_niveau_liste1');
        }
        return $this->render('niveau/add.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    //modification niveau
    #[Route('/niveau/{id}/edit', name: 'app_niveau_edit', methods: ['GET', 'POST'])]
    public function edit(Niveau $niveau, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(NiveauType::class, $niveau);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($niveau);
            $manager->flush();
            return $this->redirectToRoute('app_niveau_liste1');
        }
        return $this->render('niveau/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

