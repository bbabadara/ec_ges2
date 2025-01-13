<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Repository\ClasseRepository;
use App\Repository\FiliereRepository;
use App\Repository\NiveauRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClasseController extends AbstractController
{
    #[Route('/classe/index', name: 'classe_index', methods: ["GET"])]
    public function index( ClasseRepository $classeRepo, NiveauRepository $niveauRepo, FiliereRepository $filiereRepo,Request $request ): Response
     {
        // Récupérer les filtres de niveau et de filière
        $niveauId = $request->query->get('niveau');
        $filiereId = $request->query->get('filiere');

        // Construire la condition de filtre
        $criteria = [];
        if ($niveauId) {
            $criteria['niveau'] = $niveauId;
        }
        if ($filiereId) {
            $criteria['filiere'] = $filiereId;
        }

        // Nombre total d'éléments filtrés
        $total = $classeRepo->count($criteria);

        // Nombre total d'éléments par page
        $perPage = 5;

        // Nombre total de pages
        $nbrPages = ceil($total / $perPage);

        // Page courante
        $page = $request->query->getInt('page', 1);

        // Vérification de la page courante
        if ($page < 1) {
            $page = 1;
        }
        if ($page > $nbrPages) {
            $page = $nbrPages;
        }

        // Calcul du premier élément de la liste
        $offset = ($page - 1) * $perPage;

        // Sélection des classes avec les filtres appliqués
        $classes = $classeRepo->findBy($criteria, ['id' => 'ASC'], $perPage, $offset);

        // Récupérer les niveaux et les filières pour les sélecteurs
        $niveaux = $niveauRepo->findAll();
        $filieres = $filiereRepo->findAll();

        return $this->render('classe/index.html.twig', [
            'data' => $classes,
            'nbrPages' => $nbrPages,
            'page' => $page,
            'niveaux' => $niveaux,
            'filieres' => $filieres,
            'selectedNiveau' => $niveauId,
            'selectedFiliere' => $filiereId,
        ]);
    }

    #[Route('/classe/create', name: 'classe_create', methods: ["GET", "POST"])]
    public function create(Request $request, \Doctrine\Persistence\ManagerRegistry $doctrine): Response
    {
        $classe = new Classe();
        $form = $this->createForm(ClasseType::class, $classe);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Save the new Classe
            $entityManager = $doctrine->getManager();
            $entityManager->persist($classe);
            $entityManager->flush();

            // Redirect to the index page
            return $this->redirectToRoute('classe_index');
        }

        return $this->render('classe/create.html.twig', [
            'formClasse' => $form->createView(),
        ]);
    }
}
