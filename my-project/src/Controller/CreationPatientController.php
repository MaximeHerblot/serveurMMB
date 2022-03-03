<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class CreationPatientController extends AbstractController
{
    /**
     * @Route("/creation/patient", name="app_creation_patient")
     */
    public function index(UserPasswordHasherInterface $passwordHasher): Response
    {
        // $user = new User();
        
        return $this->render('creation_patient/index.html.twig', [
            'controller_name' => 'CreationPatientController',
        ]);
    }
}
