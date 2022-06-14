<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Haie;
use App\Repository\CategorieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;


class CreationHaieController extends AbstractController
{
    #[Route('/creation/haie', name: 'app_creation_haie')]
    public function index(CategorieRepository $categorieRepository): Response
    {

        $categories = $categorieRepository->findAll();

        return $this->render('creation_haie.html.twig', [
            'controller_name' => 'CreationHaieController',
            'categories' => $categories,
        ]);
    }

    #[Route('/creation/haie/validee', name: 'app_creation_haie_validee')]
    public function validee(ManagerRegistry $doctrine, Request $request, CategorieRepository $categorieRepository): Response
    {
        $entityManager = $doctrine->getManager();

        $nom = $request->get('nom');
        $prix = $request->get('prix');
        $cat = $request->get('categorie');

        $categorie = $categorieRepository->find($cat);

        $haie = new Haie();
        $haie->setNom($nom);
        $haie->setPrix($prix);
        $haie->setCategorie($categorie);


        $entityManager->persist($haie);

        $entityManager->flush();

        return $this->redirectToRoute('app_liste_haie');
    }
}
