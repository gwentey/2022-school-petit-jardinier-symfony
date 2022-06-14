<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Haie;
use App\Repository\CategorieRepository;
use App\Repository\HaieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class ModifierHaieController extends AbstractController
{

    #[Route('/modifier/haie/validee', name: 'app_modifier_haie_validee')]
    public function validee(HaieRepository $haieRepository, ManagerRegistry $doctrine, Request $request, CategorieRepository $categorieRepository): Response
    {
        $entityManager = $doctrine->getManager();
    
        $id = $request->get('id');
        $nom = $request->get('nom');
        $prix = $request->get('prix');
        $cat = $request->get('categorie');

        $haie = $haieRepository->find($id);
        $categorie = $categorieRepository->find($cat);

        $haie->setNom($nom);
        $haie->setPrix($prix);
        $haie->setCategorie($categorie);


        $entityManager->persist($haie);
        $entityManager->flush();

        return $this->redirectToRoute('app_liste_haie');
    }

    #[Route('/modifier/haie/{id}', name: 'app_modifier_haie')]
    public function index(int $id, HaieRepository $haieRepository, CategorieRepository $categorieRepository): Response
    {
        $haie = $haieRepository->find($id);
        $categories = $categorieRepository->findAll();

        return $this->render('modifier_haie.html.twig', [
            'controller_name' => 'ModifierHaieController',
            'haie' => $haie,
            'categories' => $categories
        ]);
    }
}
