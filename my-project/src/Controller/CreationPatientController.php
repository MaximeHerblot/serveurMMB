<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;


class CreationPatientController extends AbstractController
{
    /**
     * @Route("/creation/patient", name="app_creation_patient")
     */
    public function index(UserPasswordHasherInterface $passwordHasher, ManagerRegistry $doctrine): Response
    {
        // $user = new User();
        $em = $doctrine->getManager();
        $PM = $_POST;

        $patient = new Patient();
        $patient->setNom($PM["nom"]);
        $patient->setPrenom($PM["prenom"]);
        $patient->setDateNaissance($PM["dateNaissance"]);
        $patient->setAge($PM["age"]);
        $patient->setMaladie($PM["maladie"]);


        $user = $doctrine->getRepository(User::class)->find($PM["idMedecin"]);
        $patient->setMedecin($user);
        $em->persist($patient);
        $em->flush();
        return new Response('Saved new patient with id '.$patient->getId());

    }
}
