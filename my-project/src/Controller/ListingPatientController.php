<?php

namespace App\Controller;

use App\Entity\User;
use ContainerZx3qGON\getPatientRepositoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Util\Json;

class ListingPatientController extends AbstractController
{
    /**
     * @Route("/listing/patient", name="app_listing_patient")
     */
    public function index(ManagerRegistry $doctrine)
    {
        $em = $doctrine->getManager();
        $PM = $_GET;
        $user = $doctrine->getRepository(User::class)->findOneBy([ "authToken" => $PM["tokenMedecin"]]);
        // $user = $doctrine->getRepository(User::class)->find(1);

        // dd($user);
        //$user->getPatients();
        $patients = $user->getPatients()->toArray();
        $listPatient = [];
        $i = 0;
        foreach($patients as $patient){
            $maladies = array_filter($patient->getMaladie());

            $strMaladie = '';
            foreach($maladies as $maladie){
                $strMaladie .= $maladie['maladie'].' : '.$maladie['description'].', '; 
            }
            $strMaladie = substr($strMaladie,0,-2);
            $list = [
                "id" => $patient->getId(),
                "nom" => $patient->getNom(),
                "prenom" => $patient->getPrenom(),
                "dateNaissance" => $patient->getDateNaissance()->format('d/m/Y'),
                "age" => $patient->getAge(),
                "maladie" => strlen($strMaladie) > 0 ? $strMaladie: "Aucune",
            ];

            // return var_dump($patient->getMaladie());
            



            // foreach ($patient as $intInfo => $info) {
            //     echo "jfkdlsjfmlsdjqfkl";
            //     $list[$intInfo] = $info;
            //     if($intInfo == "medecin"){

            //     }else if("dateNaissance" == $intInfo){
                    
            //         $list[$intInfo] = $info->format('Y-m-d H:i:s');
            //         // $d->format('Y-m-d\TH:i:s.u')
            //     }
            // }
            $listPatient[$i] = $list;
            $i ++;
        }
        
        // return $this->json($patients);
        // dd($patients);

    //     array:1 [▼
    //     0 => 
    //       -id: 1
    //       -nom: "nom"
    //       -prenom: "prenom"
    //       -date_naissance: DateTime @1362614400 {#852 ▶}
    //       -age: 8
    //       -maladie: null
    //       -medecin: App\Entity\User {#768 ▶}
    //     }
    //   ]

        // ['0' => ['id'=>1,]]


        $response = new JsonResponse($listPatient);
        return $response;
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
