<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class ApiLoginController extends AbstractController
{
    /**
     * @Route("/api/login", name="api_login")
     */
    public function index(UserPasswordHasherInterface $passwordHasher, ManagerRegistry $doctrine): Response
    {
        
        // $user = $this->getUser();
        
        
        // if (null === $user) {
        //     return $this->json([
        //         'message' => 'missing credentials',
        //         ], Response::HTTP_UNAUTHORIZED);
        // }
        // dd($user->getId())
        // $token = ; // somehow create an API token for $user
        
        $post = $_POST;
        $username = $post['username'];
        $password = $post['password'];
        
        $userRepo = $doctrine->getRepository(User::class);
        $user = $userRepo->findOneBy(['username'=> $username]);
        if ($user === null){
            return $this->json([
                'message' => 'missing credentials',
            ], Response::HTTP_UNAUTHORIZED); 
        }
        //check mdp 
        $passwordUser = $user->getPassword();
        $passhash = md5($password);
        // return $this->json([
        //     'pass1' => $passwordUser,
        //     'passhash' => $passhash
        // ]);
        if ($passhash != $passwordUser){
            return $this->json([
                'message' => 'missing credentials',
            ], Response::HTTP_UNAUTHORIZED);
        } else {

            $token = md5(md5($user->getId()));
            $user->setAuthToken($token);
            $em = $doctrine->getManager();
            $em->persist($user);
            $em->flush();
            return $this->json([
                'user'  => $user->getUsername(),
                'token' => $token,
            ]);
        }
    }
}
