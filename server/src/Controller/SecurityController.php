<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityController extends AbstractController
{
    
    #[Route('/register', name: 'register', methods: 'post')]   
    public function register(ManagerRegistry $doctrine, Request $request, UserPasswordHasherInterface $encoder)
    {
        $em = $this->$doctrine->getManager();
        // IMP! To get JSON format from POST method
        $data = $request->getContent();
        $content = json_decode($data);

        $username = $content->username;
        $password = $content->password;

        $user = new User($username);
        $user->setPassword($encoder->hashPassword($user, $password));

        $em->persist($user);
        $em->flush();

        return new Response(sprintf('User %s successfully created', $user->getUsername()));
    }
     
    #[Route("/role", name:"role", methods:"post")]    
    public function role(ManagerRegistry $doctrine, Request $request, UserPasswordHasherInterface $encoder)
    {
        $em = $this->$doctrine->getManager();
        // IMP! To get JSON format from POST method
        $data = $request->getContent();
        $content = json_decode($data);
        $username = $content->username;
        $db_user = $em->getRepository(User::class)->findOneBy([
            'username' => $username,
        ]);

        return new Response( $db_user->getRoles());
    }

    #[Route("/state", name:"get-state")]    
    public function getState(ManagerRegistry $doctrine,Request $request){
        $em = $this->$doctrine->getManager();
        $data = $request->getContent();
        $content = json_decode($data);
        $username = $content->username;
        $db_user = $em->getRepository(User::class)->findOneBy([ 'username' => $username ]);
        $state = $db_user->getState();

        return $this->json([ "state" => $state ]);
    }
}