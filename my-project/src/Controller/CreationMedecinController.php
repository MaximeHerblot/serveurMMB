<?php

namespace App\Controller;

use App\Entity\User;
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
        $user = new User();
        $post = $_POST;
        $username = $post['username'];
        $firstname = $post['prenom'];
        $lastname = $post['nom'];
        $hashedPassword = md5($post['mdp']);
        // $hashedPassword = $passwordHasher->hashPassword(
        //     $user,
        //     $post['mdp']
        // );

        $user->setUsername($username)
            ->setFirstname($firstname)
            ->setLastname($lastname)
            ->setPassword($hashedPassword);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        $idUser = $user->getId();
        return new Response($idUser);
    }
}
