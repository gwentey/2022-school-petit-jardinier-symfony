<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function index(): Response
    {

        return $this->render('accueil.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }
}
