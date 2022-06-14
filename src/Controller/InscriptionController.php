<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Notification\Notification;


class InscriptionController extends AbstractController
{
    #[Route('inscription', name: 'inscription')]
    public function inscrit(UserPasswordHasherInterface $passwordHasher, Request $request, ManagerRegistry $doctrine): Response
    {

    
        return $this->render('inscription.html.twig', [
            'controller_name' => 'InscriptionController',
        ]);
    }

    #[Route('/inscription/validee', name: 'inscription_validee')]
    public function index(NotifierInterface $notifier, UserPasswordHasherInterface $passwordHasher, Request $request, ManagerRegistry $doctrine): Response
    {

        $entityManager = $doctrine->getManager();
        $username = $request->get('_username');
        $password = $request->get('_password');

        $user = new Utilisateur();
        $plaintextPassword = $password;
        $user->setUsername($username);
        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($user);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        $notifier->send(new Notification('Succès ! Vous êtes maintenant inscrit !', ['browser']));
        return $this->redirectToRoute('connexion');
    
        return $this->render('inscription.html.twig', [
            'controller_name' => 'InscriptionController',
        ]);
    }
}
