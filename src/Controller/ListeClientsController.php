<?php

namespace App\Controller;

use App\Repository\HaieRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;

class ListeClientsController extends AbstractController
{
    #[Route('/liste/clients', name: 'app_liste_clients')]
    public function index(UtilisateurRepository $utilisateurRepository): Response
    {

        $utilisateurs = $utilisateurRepository->findAll();

        return $this->render('liste_clients.html.twig', [
            'controller_name' => 'ListeClientsController',
            'clients' => $utilisateurs,
            'username' => "",
        ]);
    }


    #[Route('/liste/chercher', name: 'app_liste_haie_chercher')]
    public function cherch(Request $request, HaieRepository $haieRepository, UtilisateurRepository $utilisateurRepository): Response
    {
        $request = Request::createFromGlobals();

        $username = $request->get('username');

        $client = $utilisateurRepository->findByName($username);

        $clients = array();
        array_push($clients, $client);
        if(count($clients) == 0){
            $clients = $utilisateurRepository->findAll();
        } 
        if ($username == "") {
            $clients = $utilisateurRepository->findAll();
        }
        
        return $this->render('liste_clients.html.twig', [
            'controller_name' => 'ListeClientsController',
            'clients' => $clients,
            'username' => $username,
        ]);
    }
}
