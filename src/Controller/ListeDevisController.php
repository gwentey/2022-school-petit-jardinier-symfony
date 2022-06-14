<?php

namespace App\Controller;

use App\Repository\DevisRepository;
use App\Repository\TaillerRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Notification\Notification;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;


class ListeDevisController extends AbstractController
{
    #[Route('/liste/devis', name: 'app_liste_devis')]
    public function index(NotifierInterface $notifier, UtilisateurRepository $utilisateurRepository, UserInterface $userInterface): Response
    {

        $identifantUser = $userInterface->getUserIdentifier();
        $utilisateur = $utilisateurRepository->findOneBy(['username' => $identifantUser]);

        $lesDevis = $utilisateur->getDevis();

        return $this->render('liste_devis.html.twig', [
            'controller_name' => 'ListeDevisController',
            'lesDevis' => $lesDevis,
        ]);
    }

    #[Route('/suppression/devis/{id}', name: 'app_suppression_devis')]
    public function supression(int $id, ManagerRegistry $doctrine, TaillerRepository $taillerRepository, Request $request, DevisRepository $devisRepository): Response
    {
        $devis = $devisRepository->find($id);
        $taillers = $taillerRepository->findBy(['devis' => $id]);

        $entityManager = $doctrine->getManager();

        foreach($taillers as $tailler){
        $entityManager->remove($tailler);
        $entityManager->flush();
        }

        $devis->setUtilisateur(null);
        $entityManager->flush();

        
        return $this->redirectToRoute('app_liste_devis');
    }
}
