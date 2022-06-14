<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class ListeCategorieController extends AbstractController
{
    #[Route('/liste/categorie', name: 'app_liste_categorie')]
    public function index(CategorieRepository $categorieRepository): Response
    {

        $categories = $categorieRepository->findAll();

        return $this->render('liste_categorie.html.twig', [
            'controller_name' => 'ListeCategorieController',
            'categories' => $categories,
        ]);
    }

    #[Route('/suppression/categorie/{id}', name: 'app_suppression_categorie')]
    public function supression(int $id, ManagerRegistry $doctrine, Request $request, CategorieRepository $categorieRepository): Response
    {
        $categorie = $categorieRepository->find($id);

        $entityManager = $doctrine->getManager();

        $entityManager->remove($categorie);
        $entityManager->flush();


        return $this->redirectToRoute('app_liste_haie');
    }
}
