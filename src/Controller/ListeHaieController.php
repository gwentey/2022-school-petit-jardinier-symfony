<?php

namespace App\Controller;

use App\Repository\HaieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Extra\String\StringExtension;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class ListeHaieController extends AbstractController
{
    #[Route('/liste/haie', name: 'app_liste_haie')]
    public function index(HaieRepository $haieRepository): Response
    {

        $lesHaies = $haieRepository->findAll();

        return $this->render('liste_haie.html.twig', [
            'controller_name' => 'ListeHaieController',
            'haies' => $lesHaies,
        ]);
    }

    #[Route('/suppression/haie/{id}', name: 'app_suppression_haie')]
    public function supression(int $id, ManagerRegistry $doctrine, Request $request, HaieRepository $haieRepository): Response
    {
        $haie = $haieRepository->find($id);

        $entityManager = $doctrine->getManager();

        $entityManager->remove($haie);
        $entityManager->flush();

        return $this->redirectToRoute('app_liste_haie');
    }


    
}
