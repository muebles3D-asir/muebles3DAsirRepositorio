<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends AbstractController
{
    #[Route('/user/new', name: 'app_user_new', methods: 'post')]
    public function new(ManagerRegistry $doctrine, Request $request): JsonResponse {

      $data = $request->getContent();

      $user_stdClass = json_decode($data);

      $em = $doctrine->getManager(); // Entity Manager

      foreach ($user_stdClass as $userData) {
        $user = new User();
        $user->setName($userData->name);
        $orderTotal = intval($userData->orderTotal);
        $user->setOrderTotal($orderTotal);
        $user->setName($userData->name);
        $user->setPassword($userData->password);
        $user->setMail($userData->mail);
        $user->setRol($userData->rol);


        $em->persist($user);
      }

      $em->flush();


      $result = [
        'name' => $user->getName(),
        'password' => $user->getPassword(),
        'email' => $user->getMail(),
        'rol' => $user->getRol(),
        'orderTotal' => $user->getOrderTotal(),

      ];

      return $this->json([$result]);
    }

    #[Route('/user', name: 'app_user_list', methods:"get")]
    public function userList(ManagerRegistry $doctrine): JsonResponse {
      $users = $doctrine->getRepository(User::class)->findAll();
      $users_json = [];

      foreach ($users as $user) {
        $users_json[] = [
            'name' => $user->getName(),
            'password' => $user->getPassword(),
            'email' => $user->getMail(),
            'rol' => $user->getRol(),
            'orderTotal' => $user->getOrderTotal(),
        ];
      }

      return $this->json([$users_json]);
    }

    #[Route('/user/{id}', name: 'app_user_details')]
    public function userDetails(ManagerRegistry $doctrine, $id): JsonResponse {
      $user = $doctrine->getRepository(User::class)->findOneBy(["id" => $id]);

      $user_json = [
        'name' => $user->getName(),
        'password' => $user->getPassword(),
        'email' => $user->getMail(),
        'rol' => $user->getRol(),
        'orderTotal' => $user->getOrderTotal(),
      ];

      return $this->json($user_json);
    }

    #[Route('/user-delete/{id}', name: 'app_user_delete')]
    public function userDelete(ManagerRegistry $doctrine, $id): JsonResponse {

    $em = $doctrine->getManager();
      $user = $doctrine->getRepository(User::class)->findOneBy(["id" => $id]);


      $em->remove($user);
      $em->flush();



      return $this->json(["Mensaje"=>"eliminado"]);
    }

    #[Route('/user/{id}/', name: 'app_user_edit', methods: 'post')]
    public function userEdit(ManagerRegistry $doctrine, $id, Request $request): JsonResponse {
        $user = $doctrine->getRepository(User::class)->findOneBy(["id" => $id]);
        if (!$user) {
            throw $this->createNotFoundException('The user does not exist');
        } else{

            $data = $request->getContent();

            $user_stdClass = json_decode($data);

            $em = $doctrine->getManager(); // Entity Manager

            foreach ($user_stdClass as $userData) {
              $user->setName($userData->name);
              $orderTotal = intval($userData->orderTotal);
              $user->setOrderTotal($orderTotal);
              $user->setName($userData->name);
              $user->setPassword($userData->password);
              $user->setMail($userData->mail);
              $user->setRol($userData->rol);


              $em->persist($user);
            }

            $em->flush();


            $result = [
              'name' => $user->getName(),
              'password' => $user->getPassword(),
              'email' => $user->getMail(),
              'rol' => $user->getRol(),
              'orderTotal' => $user->getOrderTotal(),

            ];

            return $this->json([$result]);
          }
        }
    }

