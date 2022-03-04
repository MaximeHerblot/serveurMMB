<?php

namespace App\Controller;

use App\Entity\User;
use ContainerZx3qGON\getPatientRepositoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class ListingPatientController extends AbstractController
{
    /**
     * @Route("/listing/patient", name="app_listing_patient")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $PM = $_POST;
        // $user = $doctrine->getRepository(User::class)->find($PM["idMedecin"]);
        $user = $doctrine->getRepository(User::class)->find(1);

        // dd($user);
        //$user->getPatients();
        $patients = $user->getPatients()->toArray();
        

        dd($patients);



        $response = JsonResponse::fromJsonString('{
            "1" : {
                "nom": "Doe",
                "prenom": "John",
                "age": 45,
                "maladie": "Sida",
                "dateAjout": "03/03/2022"
            },
            "2": {
                "nom": "Harris",
                "prenom": "Kane",
                "age": 38,
                "maladie": "Cancer poumon",
                "dateAjout": "03/03/2022"
            },
            "3": {
                "nom": "Alonso",
                "prenom": "Marco",
                "age": 24,
                "maladie": "Diabetique",
                "dateAjout": "03/03/2022"
            }
        }');
        return $response;
    }
}
