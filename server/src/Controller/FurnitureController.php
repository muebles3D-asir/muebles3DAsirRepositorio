<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Furniture;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class FurnitureController extends AbstractController {

   #[Route('/furniture', name: 'app_furniture_new', methods: 'post')]
   public function new(ManagerRegistry $doctrine, Request $request): JsonResponse {
      $em = $doctrine->getManager(); // Entity Manager

      $data = $request->getContent();
      $furniture_stdClass = json_decode($data);

      $furniture = new Furniture();
      $furniture->setName($furniture_stdClass->name);
      $furniture->setPrice($furniture_stdClass->price);
      $furniture->setRating($furniture_stdClass->rating);
      $furniture->setShortDescription($furniture_stdClass->shortDescription);
      $furniture->setDescription($furniture_stdClass->description);
      $furniture->setImage($furniture_stdClass->image);
      $furniture->setCategories($furniture_stdClass->categories);
      $furniture->setFilamento($furniture_stdClass->filamento);
      $furniture->setColor($furniture_stdClass->color);
      $furniture->setMaterial($furniture_stdClass->material);
      $furniture->setTamaño($furniture_stdClass->tamaño);

      $em->persist($furniture);
      $em->flush();

      $result = [
         'id' => $furniture->getId(),
         'name' => $furniture->getName(),
         'price' => $furniture->getPrice(),
         'rating' => $furniture->getRating(),
         'shortDescription' => $furniture->getShortDescription(),
         'description' => $furniture->getDescription(),
         'image' => $furniture->getImage(),
         'categories' => $furniture->getCategories(),
         'filamento' => $furniture->getFilamento(),
         'color' => $furniture->getColor(),
         'material' => $furniture->getMaterial(),
         'tamaño' => $furniture->getTamaño()
      ];

      return $this->json($result);
   }

   #[Route('/furniture', name: 'app_furniture_list', methods: 'get')]
   public function furnitureList(ManagerRegistry $doctrine): JsonResponse {
      $furnitures = $doctrine->getRepository(Furniture::class)->findAll();
      $furnitures_json = [];

      foreach ($furnitures as $furniture) {
         $furnitures_json[] = [
            'id' => $furniture->getId(),
            'name' => $furniture->getName(),
            'price' => $furniture->getPrice(),
            'rating' => $furniture->getRating(),
            'shortDescription' => $furniture->getShortDescription(),
            'description' => $furniture->getDescription(),
            'image' => $furniture->getImage(),
            'categories' => $furniture->getCategories(),
            'filamento' => $furniture->getFilamento(),
            'color' => $furniture->getColor(),
            'material' => $furniture->getMaterial(),
            'tamaño' => $furniture->getTamaño()
         ];
      }

      return $this->json($furnitures_json);
   }

   #[Route('/furniture/{id}', name: 'app_furniture_details', methods: 'get')]
   public function furnitureDetails(ManagerRegistry $doctrine, $id): JsonResponse {
      $furniture = $doctrine->getRepository(Furniture::class)->findOneBy(["id" => $id]);

      $furniture_json = [
         'id' => $furniture->getId(),
         'name' => $furniture->getName(),
         'price' => $furniture->getPrice(),
         'rating' => $furniture->getRating(),
         'shortDescription' => $furniture->getShortDescription(),
         'description' => $furniture->getDescription(),
         'image' => $furniture->getImage(),
         'categories' => $furniture->getCategories(),
         'filamento' => $furniture->getFilamento(),
         'color' => $furniture->getColor(),
         'material' => $furniture->getMaterial(),
         'tamaño' => $furniture->getTamaño()
      ];

      return $this->json($furniture_json);
   }

   #[Route('/furniture/{id}', name: 'app_furniture_delete', methods: 'delete')]
   public function furnitureDelete(ManagerRegistry $doctrine, $id): JsonResponse {
      $furniture = $doctrine->getRepository(Furniture::class)->findOneBy(["id" => $id]);
      $em = $doctrine->getManager(); // Entity Manager
      $em->remove($furniture);
      $em->flush();
      return $this->json(["Mensaje" => "Eliminado correctamente"]);
   }

   #[Route('/furniture/{id}', name: 'app_furniture_edit', methods: 'put')]
   public function furnitureEdit(ManagerRegistry $doctrine, $id, Request $request): JsonResponse {
      $em = $doctrine->getManager();
      $furniture = $doctrine->getRepository(Furniture::class)->findOneBy(["id" => $id]);
      $data = $request->getContent();
      $furniture_stdClass = json_decode($data);

      $furniture->setName($furniture_stdClass->name);
      $furniture->setPrice($furniture_stdClass->price);
      $furniture->setRating($furniture_stdClass->rating);
      $furniture->setShortDescription($furniture_stdClass->shortDescription);
      $furniture->setDescription($furniture_stdClass->description);
      $furniture->setImage($furniture_stdClass->image);
      $furniture->setCategories($furniture_stdClass->categories);
      $furniture->setfilamento($furniture_stdClass->filamento);
      $furniture->setcolor($furniture_stdClass->color);
      $furniture->setmaterial($furniture_stdClass->material);
      $furniture->settamaño($furniture_stdClass->tamaño);

      $em->persist($furniture);
      $em->flush();

      $furniture_json = [
         'id' => $furniture->getId(),
         'name' => $furniture->getName(),
         'price' => $furniture->getPrice(),
         'rating' => $furniture->getRating(),
         'shortDescription' => $furniture->getShortDescription(),
         'description' => $furniture->getDescription(),
         'image' => $furniture->getImage(),
         'categories' => $furniture->getCategories(),
         'filamento' => $furniture->getFilamento(),
         'color' => $furniture->getColor(),
         'material' => $furniture->getMaterial(),
         'tamaño' => $furniture->getTamaño()

      ];
      return $this->json($furniture_json);
   }
}
