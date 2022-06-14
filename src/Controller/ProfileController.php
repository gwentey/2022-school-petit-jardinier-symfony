<?php

namespace App\Controller;

use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(ManagerRegistry $doctrine, UtilisateurRepository $utilisateurRepository, UserInterface $userInterface): Response
    {

        $identifantUser = $userInterface->getUserIdentifier();
        $utilisateur = $utilisateurRepository->findOneBy(['username' => $identifantUser]);


        return $this->render('profile.html.twig', [
            'controller_name' => 'ProfileController',
            'utilisateur' => $utilisateur,
        ]);
    }

    #[Route('/profile/modifier/{id}', name: 'app_profile_modif')]
    public function modif(int $id, Request $request, ManagerRegistry $doctrine, UtilisateurRepository $utilisateurRepository, UserInterface $userInterface): Response
    {
        $utilisateur = $utilisateurRepository->find($id);

        $entityManager = $doctrine->getManager();

        $nom = $request->get('nom');
        $prenom = $request->get('prenom');
        $adresse = $request->get('adresse');
        $ville = $request->get('ville');
        $cp = $request->get('cp');
        $typeclient = $request->get('typeclient');

        $utilisateur->setNom($nom);
        $utilisateur->setPrenom($prenom);
        $utilisateur->setAdresse($adresse);
        $utilisateur->setVille($ville);
        $utilisateur->setCp($cp);
        $utilisateur->setTypeClient($typeclient);

        $entityManager->persist($utilisateur);

        $entityManager->flush();




        return $this->render('profile.html.twig', [
            'controller_name' => 'ProfileController',
            'utilisateur' => $utilisateur,
        ]);
    }
}
