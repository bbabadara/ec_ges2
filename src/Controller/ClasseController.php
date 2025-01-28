<?php
namespace App\Controller;
use App\Entity\Classe;
use App\Form\ClasseType;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// lister classes
class ClasseController extends AbstractController
{
    #[Route('/classe/liste',  name: 'app_classe_liste',methods: ['GET'])]
    public function index(ClasseRepository $classeRepository,PaginatorInterface $paginator, Request $request): Response
    {
        $data = $classeRepository->findAll();
        $classes = $paginator->paginate(
            $data, /* query NOT result */
            $request->query->getInt('page', 1), /* page number */
            5 /* limit per page */
        );
        return $this->render('classe/liste.html.twig', [
            'classes' => $classes,
        ]);
    }
    // ajouter une classe
    #[Route('/classe/add', name: 'app_classe_add', methods: ['GET', 'POST'])]
    public function add(ClasseRepository $classeRepository, Request $request, EntityManagerInterface $manager): Response
    {
        // Créer une nouvelle instance de Classe
        $classe = new Classe();
    
        // Générer le formulaire
        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);
    
        // Vérifier si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            $classe=$form->getData();
            // Persister la classe dans la base de données
            $manager->persist($classe);
            $manager->flush();
            //message de confirmation
            $this->addFlash('success', 'Classe ajoutée avec succès');
    
            // Rediriger après la soumission
            return $this->redirectToRoute('app_classe_liste');
        }
    
        // Afficher le formulaire
        return $this->render('classe/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // modifier une classe
    #[Route('/classe/{id}/edit', name: 'app_classe_edit', methods: ['GET', 'POST'])]
    public function edit(Classe $classe, Request $request, EntityManagerInterface $manager): Response
    {
        // Générer le formulaire
        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);
    
        // Vérifier si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            $classe=$form->getData();
            // Persister la classe dans la base de données
            $manager->persist($classe);
            $manager->flush();
    //message de confirmation
    $this->addFlash('success', 'Classe modifiée avec succès');

            // Rediriger après la soumission
            return $this->redirectToRoute('app_classe_liste');

        }
    
        // Afficher le formulaire
        return $this->render('classe/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // supprimer une classe
    #[Route('/classe/{id}/delete', name: 'app_classe_delete', methods: ['GET',])]
    public function delete(Classe $classe, Request $request, EntityManagerInterface $manager): Response
    {
        // Vérifier si le token CSRF est valide
            // Supprimer la classe
            $manager->remove($classe);
            $manager->flush();
        // Afficher un message de confirmation
        $this->addFlash('success', 'Classe supprimée avec succès');
    
        // Rediriger après la suppression
        return $this->redirectToRoute('app_classe_liste');
    }
    
}



