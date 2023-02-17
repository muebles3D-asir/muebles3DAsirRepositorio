<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    #[Route('/register', name: 'register', methods: 'post')]   
     
    public function register(ManagerRegistry $doctrine, Request $request, App\Controller\UserPasswordEncoderInterface $encoder)
    {
        $em = $this->$doctrine->getManager();
        // IMP! To get JSON format from POST method
        $data = $request->getContent();
        $content = json_decode($data);

        $username = $content->username;
        $password = $content->password;

        $user = new User($username);
        $user->setPassword($encoder->encodePassword($user, $password));

        $em->persist($user);
        $em->flush();

        return new Response(sprintf('User %s successfully created', $user->getUsername()));
    }
    
}