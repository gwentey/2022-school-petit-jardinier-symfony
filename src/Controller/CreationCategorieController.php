<?php

namespace App\Controller;

use App\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategorieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class CreationCategorieController extends AbstractController
{
    #[Route('/creation/categorie', name: 'app_creation_categorie')]
    public function index(): Response
    {
        
        return $this->render('creation_categorie.html.twig', [
            'controller_name' => 'CreationCategorieController',
        ]);
    }

    #[Route('/creation/categorie/validee', name: 'app_creation_categorie_validee')]
    public function creation(ManagerRegistry $doctrine, Request $request, CategorieRepository $categorieRepository): Response
    {
        $entityManager = $doctrine->getManager();

        $nom = $request->get('nom');

        $categorie = new Categorie();
        $categorie->setLibelle($nom);

        $entityManager->persist($categorie);

        $entityManager->flush();
        
        return $this->redirectToRoute('app_liste_categorie');
    }


    
}
