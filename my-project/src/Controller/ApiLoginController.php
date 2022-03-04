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
    public function index(?User $user, UserPasswordHasherInterface $passwordHasher, ManagerRegistry $doctrine ): Response
    {

        if (null === $user) {
            return $this->json([
                'message' => 'missing credentials',
                ], Response::HTTP_UNAUTHORIZED);
        }
            
        // $token = ; // somehow create an API token for $user
        $token = $passwordHasher->hashPassword(
            $user,
            $user->getId()
        );
        $user->setAuthToken($token);
        $em = $doctrine->getManager();
        $em->persist($user);
        $em->flush();
        return $this->json([
            'user'  => $user->getUserIdentifier(),
            'token' => $token,
        ]);
    }
}
