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
    $price = floatval($furniture_stdClass->price);
    $furniture->setPrice($price);
    $furniture->setRating($furniture_stdClass->rating);
    $furniture->setShortDescription($furniture_stdClass->shortDescription);
    $furniture->setDescription($furniture_stdClass->description);
    $furniture->setImage($furniture_stdClass->image);

    foreach ($furniture_stdClass->categories as $category_stdClass) {
      $category = new Category();
      $category->setName($category_stdClass->name);
      $em->persist($category);
      $furniture->addCategory($category);
    }

    $em->persist($furniture);

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

  #[Route('/furniture', name: 'app_furniture_list', methods:'get')]
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

  #[Route('/furniture/{id}', name: 'app_furniture_details', methods:'get')]
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

  #[Route('/furniture/{id}', name: 'app_furniture_delete', methods: 'delete')]
  public function furnitureDelete(ManagerRegistry $doctrine, $id): JsonResponse {
    // $products = $doctrine->getRepository(Product::class)->find($id);
    $furniture = $doctrine->getRepository(Furniture::class)->findOneBy(["id" => $id]);
    $em = $doctrine->getManager(); // Entity Manager
    $em->remove($furniture);
    $em->flush();
    return $this->json(["Mensaje"=>"Eliminado correctamente"]);
  }

  #[Route('/furniture/{id}', name: 'app_furniture_edit', methods:'put')]
  public function furnitureEdit(ManagerRegistry $doctrine, $id, Request $request): JsonResponse {
    $em = $doctrine->getManager(); // Entity Manager
    $furniture = $doctrine->getRepository(Furniture::class)->findOneBy(["id" => $id]);
    $data = $request->getContent();
    $furniture_stdClass = json_decode($data);

    $furniture->setName($furniture_stdClass->name);
    $price = floatval($furniture_stdClass->price);
    $furniture->setPrice($price);
    $furniture->setRating($furniture_stdClass->rating);
    $furniture->setShortDescription($furniture_stdClass->shortDescription);
    $furniture->setDescription($furniture_stdClass->description);
    $furniture->setImage($furniture_stdClass->image);

    foreach ($furniture_stdClass->categories as $category_stdClass) {
      $category = new Category();
      $category->setName($category_stdClass->name);
      $em->persist($category);
      $furniture->addCategory($category);
    }

    $em->persist($furniture);
    $em->flush();

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
