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
            "3": {
                "nom": "joe",
                "prenom": "John",
                "age": 45,
                "maladie": "Sida",
                "dateAjout": "03/03/2022"
            },
            "2": {
                "nom": "joe",
                "prenom": "Kane",
                "age": 38,
                "maladie": "Cancer poumon",
                "dateAjout": "03/03/2022"
            },
            "1": {
                "nom": "Polo",
                "prenom": "Marco",
                "age": 24,
                "maladie": "Diabetique",
                "dateAjout": "03/03/2022"
            }
        }');


        return $response;
        // return $this->render('listing_patient/index.html.twig', [
        //     'controller_name' => 'ListingPatientController',
        // ]);
    }
}
