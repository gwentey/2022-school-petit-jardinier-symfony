<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeconnectionController extends AbstractController
{
    #[Route('/deconnection', name: 'deconnection')]
    public function index(): Response
    {
        return $this->render('deconnection.html.twig', [
            'controller_name' => 'DeconnectionController',
        ]);
    }
}
