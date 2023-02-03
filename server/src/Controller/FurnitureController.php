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

  #[Route('/furniture/new', name: 'app_furniture_new', methods: 'post')]
  public function new(ManagerRegistry $doctrine, Request $request): JsonResponse {

    $data = $request->getContent();

    $furniture_stdClass = json_decode($data);

    $em = $doctrine->getManager(); // Entity Manager

    foreach ($furniture_stdClass as $furnitureData) {
      $furniture = new Furniture();
      $furniture->setName($furnitureData->name);
      $price = floatval($furnitureData->price);
      $furniture->setPrice($price);
      $furniture->setRating($furnitureData->rating);
      $furniture->setShortDescription($furnitureData->shortDescription);
      $furniture->setDescription($furnitureData->description);
      $furniture->setImage($furnitureData->image);

      foreach ($furnitureData->categories as $category_stdClass) {
        $category = new Category();
        $category->setName($category_stdClass->name);
        $em->persist($category);
        $furniture->addCategory($category);
      }

      $em->persist($furniture);
    }

    $em->flush();

    $categories = [];
    $tmp2 = [];
    foreach ($furniture->getCategories() as $categoryD) {
      $tmp2 = [
        'name' => $categoryD->getName()
      ];
      $categories[] = $tmp2;
    }

    $result = [
      'name' => $furniture->getName(),
      'price' => $furniture->getPrice(),
      'rating' => $furniture->getRating(),
      'short description' => $furniture->getShortDescription(),
      'description' => $furniture->getDescription(),
      'image' => $furniture->getImage(),
      'categories' => $categories
    ];

    return $this->json([$result]);
  }

  #[Route('/furniture', name: 'app_furniture_list', methods:"get")]
  public function furnitureList(ManagerRegistry $doctrine): JsonResponse {
    $furnitures = $doctrine->getRepository(Furniture::class)->findAll();
    $furnitures_json = [];

    foreach ($furnitures as $furniture) {
      foreach ($furniture->getCategories() as $categoryD) {
        $categories[] = [
          'name' => $categoryD->getName()
        ];
      }

      $furnitures_json[] = [
        'name' => $furniture->getName(),
        'price' => $furniture->getPrice(),
        'rating' => $furniture->getRating(),
        'short description' => $furniture->getShortDescription(),
        'description' => $furniture->getDescription(),
        'image' => $furniture->getImage(),
        'categories' => $categories
      ];
    }

    return $this->json([$furnitures_json]);
  }

  #[Route('/furniture/{id}', name: 'app_furniture_details')]
  public function furnitureDetails(ManagerRegistry $doctrine, $id): JsonResponse {
    // $products = $doctrine->getRepository(Product::class)->find($id);
    $furniture = $doctrine->getRepository(Furniture::class)->findOneBy(["id" => $id]);
    $categories = [];
    foreach ($furniture->getCategories() as $categoryD) {
      $categories[] = [
        'name' => $categoryD->getName()
      ];
    }
    $furniture_json = [
      'name' => $furniture->getName(),
      'price' => $furniture->getPrice(),
      'rating' => $furniture->getRating(),
      'short description' => $furniture->getShortDescription(),
      'description' => $furniture->getDescription(),
      'image' => $furniture->getImage(),
      'categories' => $categories
    ];

    return $this->json($furniture_json);
  }

  #[Route('/furniture/{id}/{name}', name: 'app_furniture_edit')]
  public function furnitureEdit(ManagerRegistry $doctrine, $id, $name): JsonResponse {
    $em = $doctrine->getManager(); // Entity Manager
    $furniture = $doctrine->getRepository(Furniture::class)->findOneBy(["id" => $id]);
    $furniture->setName($name);
    $em->persist($furniture);
    $em->flush();

    $furniture = $doctrine->getRepository(Furniture::class)->findOneBy(["id" => $id]);
    $categories = [];
    foreach ($furniture->getCategories() as $categoryD) {
      $categories[] = [
        'name' => $categoryD->getName()
      ];
    }
    $furniture_json = [
      'name' => $furniture->getName(),
      'price' => $furniture->getPrice(),
      'rating' => $furniture->getRating(),
      'short description' => $furniture->getShortDescription(),
      'description' => $furniture->getDescription(),
      'image' => $furniture->getImage(),
      'categories' => $categories
    ];
    return $this->json([$furniture_json]);
  }
}
