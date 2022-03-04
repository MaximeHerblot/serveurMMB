<?php

namespace App\Controller;

use App\Entity\Patient;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonDecode;

class ModificationPatientController extends AbstractController
{
    /**
     * @Route("/modification/patient", name="app_modification_patient")
     */
    public function index(ManagerRegistry $doctrine): Response
    {

        $token = $_POST["medecinToken"];
        $userRepo = $doctrine->getRepository(User::class);
        //$repo->findBy(['property'=>value]);
        $idPatient = $_POST["idPatient"];
        $patientRepo = $doctrine->getRepository(Patient::class);
        $patient = $patientRepo->find($idPatient);
        $maladie = $_POST["maladie"];
        $array = json_decode($maladie, true);
        $patient->setMaladie($array);
        $em = $doctrine->getManager();
        $em->persist($patient);
        $em->flush();
        //Récupérer les maladies en post 
        //transforme string(json) en tableau
        //->setMaladie(tableau juste créer)
        
        return $this->render('modification_patient/index.html.twig', [
            'controller_name' => 'ModificationPatientController',
        ]);
    }
}