<?php

namespace App\Controller;

use App\Repository\HaieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Notifier\Notification\Notification;
use App\Repository\UtilisateurRepository;
use App\Entity\Devis;
use App\Entity\Tailler;
use App\Repository\DevisRepository;
use App\Repository\TaillerRepository;
use Doctrine\Persistence\ManagerRegistry;



class MesureController extends AbstractController
{
    #[Route('/mesure', name: 'mesure')]
    public function index(HaieRepository $haieRepository): Response
    {
        $lesHaies = $haieRepository->findAll();

        return $this->render('mesure.html.twig', [
            'controller_name' => 'MesureController',
            'lesHaies' => $lesHaies,
        ]);
    }

    #[Route('/mesure/validee', name: 'mesure_validee')]
    public function cree(ManagerRegistry $doctrine, HaieRepository $haieRepository, UtilisateurRepository $utilisateurRepository, UserInterface $userInterface, NotifierInterface $notifier): Response
    {

        $identifantUser = $userInterface->getUserIdentifier();
        $utilisateur = $utilisateurRepository->findOneBy(['username' => $identifantUser]);

        if ($utilisateur->getTypeClient() == null) {
            $notifier->send(new Notification('Erreur ! Vous devez renseigner votre type de profil !', ['browser']));
            return $this->redirectToRoute('app_profile');
        } else {
            $choix = $utilisateur->getTypeClient();
        }


        $request = Request::createFromGlobals();

        $type = $request->get('type');
        $hauteur = $request->get('hauteur');
        $longueur = $request->get('longueur');

        $haieSelection = $haieRepository->find($type);

        //ajouter dans la table devis
        $devis = new Devis();
        date_default_timezone_set('Europe/Paris');
        $devis->setDate(new \DateTime('today'));
        $devis->setUtilisateur($utilisateur);

        $entityManager = $doctrine->getManager();
        $entityManager->persist($devis);
        $entityManager->flush();

        //ajouter dans la table tailler 
        $tailler = new Tailler();
        $tailler->setDevis($devis);
        $tailler->setHaie($haieSelection);
        $tailler->setHauteur($hauteur);
        $tailler->setLongueur($longueur);

        $entityManager = $doctrine->getManager();
        $entityManager->persist($tailler);
        $entityManager->flush();



        return $this->redirectToRoute('devis',  array(
            'id' => $devis->getId(),
        ));
    }

    #[Route('/mesure/add/{id}', name: 'mesure_add')]
    public function add(int $id, HaieRepository $haieRepository): Response
    {
        $lesHaies = $haieRepository->findAll();

        return $this->render('mesure.html.twig', [
            'controller_name' => 'MesureController',
            'lesHaies' => $lesHaies,
            'devis' => $id,
        ]);
    }


    #[Route('/mesure/add/{id}/validee', name: 'mesure_add_validee')]
    public function add_validee(int $id, TaillerRepository $taillerRepository, DevisRepository $devisRepository, ManagerRegistry $doctrine, HaieRepository $haieRepository, UtilisateurRepository $utilisateurRepository, UserInterface $userInterface, NotifierInterface $notifier): Response
    {

        $request = Request::createFromGlobals();

        $type = $request->get('type');
        $hauteur = $request->get('hauteur');
        $longueur = $request->get('longueur');

        $haieSelection = $haieRepository->find($type);

        $devis = $devisRepository->find($id);
        

        //ajouter dans la table tailler 
        $tailler = new Tailler();
        $tailler->setDevis($devis);
        $tailler->setHaie($haieSelection);
        $tailler->setHauteur($hauteur);
        $tailler->setLongueur($longueur);

        $entityManager = $doctrine->getManager();
        $entityManager->persist($tailler);
        $entityManager->flush();



        return $this->redirectToRoute('devis',  array(
            'id' => $devis->getId(),
        ));
    }
}
