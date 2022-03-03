<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class CreationMedecinController extends AbstractController
{
    /**
     * @Route("/creation/medecin", name="app_creation_medecin")
     */
    public function index(UserPasswordHasherInterface $passwordHasher): Response
    {
        // $_POST;
        
        return $this->render('creation_medecin/index.html.twig', [
            'controller_name' => 'CreationMedecinController',
        ]);
    }
}
