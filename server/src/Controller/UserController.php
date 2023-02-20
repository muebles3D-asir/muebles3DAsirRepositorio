<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends AbstractController {

  #[Route('/user', name: 'app_user_new', methods: 'post')]
  public function new(ManagerRegistry $doctrine, Request $request): JsonResponse {
    $em = $doctrine->getManager();

    $data = $request->getContent();
    $user_stdClass = json_decode($data);

    $user = new User("");
    $user->setName($user_stdClass->name);
    $user->setPassword($user_stdClass->password);
    $user->setMail($user_stdClass->email);
    $user->setRol($user_stdClass->rol);
    $user->setOrderTotal($user_stdClass->orderTotal);

    $em->persist($user);
    $em->flush();

    $result = [
      'name' => $user->getName(),
      'password' => $user->getPassword(),
      'email' => $user->getMail(),
      'rol' => $user->getRol(),
      'orderTotal' => $user->getOrderTotal()
    ];

    return $this->json([$result]);
  }

  #[Route('/user', name: 'app_user_list', methods: 'get')]
  public function userList(ManagerRegistry $doctrine): JsonResponse {
    $users = $doctrine->getRepository(User::class)->findAll();
    $users_json = [];

    foreach ($users as $user) {
      $users_json[] = [
        'name' => $user->getName(),
        'password' => $user->getPassword(),
        'email' => $user->getMail(),
        'rol' => $user->getRol(),
        'orderTotal' => $user->getOrderTotal()
      ];
    }

    return $this->json([$users_json]);
  }

  #[Route('/user/{id}', name: 'app_user_details', methods: 'get')]
  public function userDetails(ManagerRegistry $doctrine, $id): JsonResponse {
    $user = $doctrine->getRepository(User::class)->findOneBy(["id" => $id]);
    $user_json = [
      'name' => $user->getName(),
      'password' => $user->getPassword(),
      'email' => $user->getMail(),
      'rol' => $user->getRol(),
      'orderTotal' => $user->getOrderTotal()
    ];

    return $this->json($user_json);
  }

  #[Route('/user/{id}', name: 'app_user_delete', methods: 'delete')]
  public function userDelete(ManagerRegistry $doctrine, $id): JsonResponse {
    $user = $doctrine->getRepository(User::class)->findOneBy(["id" => $id]);
    $em = $doctrine->getManager();
    $em->remove($user);
    $em->flush();
    return $this->json(["Mensaje" => "Eliminado correctamente"]);
  }

  #[Route('/user/{id}', name: 'app_user_edit', methods: 'put')]
  public function userEdit(ManagerRegistry $doctrine, $id, Request $request): JsonResponse {
    $em = $doctrine->getManager();
    $user = $doctrine->getRepository(User::class)->findOneBy(["id" => $id]);
    $data = $request->getContent();
    $user_stdClass = json_decode($data);

    $user->setName($user_stdClass->name);
    $user->setPassword($user_stdClass->password);
    $user->setMail($user_stdClass->email);
    $user->setRol($user_stdClass->rol);
    $user->setOrderTotal($user_stdClass->orderTotal);

    $em->persist($user);
    $em->flush();

    $user_json = [
      'name' => $user->getName(),
      'password' => $user->getPassword(),
      'email' => $user->getMail(),
      'rol' => $user->getRol(),
      'orderTotal' => $user->getOrderTotal()
    ];
    return $this->json([$user_json]);
  }
}
