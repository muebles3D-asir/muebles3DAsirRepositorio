<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController {

  #[Route('/category', name: 'app_category_new')]
  public function new(ManagerRegistry $doctrine): JsonResponse {
    $em = $doctrine->getManager(); // Entity Manager

    $category = new Category();
    $category->setName($name);
    $em->persist($category);
    $em->flush();

    return $this->json([
      'category' => [
        "id" => $category->getId(),
        "name" => $category->getName()
      ]
    ]);
  }

  #[Route('/category-list', name: 'app_category_list')]
  public function categoryList(ManagerRegistry $doctrine): JsonResponse {
    $categories = $doctrine->getRepository(Category::class)->findAll();
    $categories_json = [];
    $tmp = [];

    foreach ($categories as $category) {
      $tmp[] = [
        "id" => $category->getId(),
        "name" => $category->getName()
      ];
    }

    $categories_json[] = $tmp;
    return $this->json(["categories" => $categories_json]);
  }

  #[Route('/category/{id}', name: 'app_category_details')]
  public function categoryDetails(ManagerRegistry $doctrine, $id): JsonResponse {
    $category = $doctrine->getRepository(Category::class)->findOneBy(["id" => $id]);
    $category_json = [
      "id" => $category->getId(),
      "name" => $category->getName()
    ];

    return $this->json($category_json);
  }

  #[Route('/category/edit/{id}/{name}', name: 'app_category_edit')]
  public function categoryEdit(ManagerRegistry $doctrine, $id, $name) {
    $em = $doctrine->getManager(); // Entity Manager
    $category = $doctrine->getRepository(Category::class)->findOneBy(["id" => $id]);
    $category->setName($name);
    $em->persist($category);
    $em->flush();
  }

  #[Route('/category/delete/{id}', name: 'app_category_edit')]
  public function categoryDelete(ManagerRegistry $doctrine, $id, $name) {
    $em = $doctrine->getManager(); // Entity Manager
    $category = $doctrine->getRepository(Category::class)->findOneBy(["id" => $id]);
    $category->setName($name);

    $em->remove($category);
    $em->flush();
  }
}
