<?php

namespace App\Controller;

use App\Entity\Patient;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModificationPatientController extends AbstractController
{
    /**
     * @Route("/modification/patient", name="app_modification_patient")
     */
    public function index(ManagerRegistry $doctrine): Response
    {

        $token = $_POST["medecinToken"];
        //$repo->findBy(['property'=>value]);
        $idPatient = $_POST["idPatient"];
        $patientRepo = $doctrine->getRepository(Patient::class);
        $patient = $patientRepo->find($idPatient);
        $maladie = $_POST["lesMaladies"];
        $array = json_decode($maladie, true);
        $patient->setMaladie($array);
        $em = $doctrine->getManager();
        $em->persist($patient);
        $em->flush();
        //Récupérer les maladies en post 
        //transforme string(json) en tableau
        //->setMaladie(tableau juste créer)
        return new Response($patient->getId());
    }
    /**
     * @Route("/modification/patient/recuperation", name="app_modification_patient_retreive")
     */
    public function retreive(ManagerRegistry $doctrine){
        $post = $_POST;
        $tokenMedecin = $post['tokenMedecin'];
        $idPatient = $post['idPatient'];

        $patientRepo = $doctrine->getRepository(Patient::class);
        $patient = $patientRepo->find($idPatient);
        // $infoPatient = [
        //     ''
        // ]
        $maladie = $patient->getMaladie();
        
        return new JsonResponse($maladie);

        
    }
}
