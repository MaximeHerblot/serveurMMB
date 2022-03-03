<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListingPatientController extends AbstractController
{
    /**
     * @Route("/listing/patient", name="app_listing_patient")
     */
    public function index(): JsonResponse
    {

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
