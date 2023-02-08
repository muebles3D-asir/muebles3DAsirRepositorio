<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController {
  #[Route('/category', name: 'app_category_new', methods: 'post')]
  public function new(ManagerRegistry $doctrine, Request $request): JsonResponse {
    $em = $doctrine->getManager();

    $data = $request->getContent();
    $category_stdClass = json_decode($data);

    $category = new Category();
    $category->setName($category_stdClass->name);

    $em->persist($category);
    $em->flush();

    $result = [
      'name' => $category->getName()
    ];

    return $this->json([$result]);
  }

  #[Route('/category', name: 'app_category_list', methods: 'get')]
  public function categoryList(ManagerRegistry $doctrine): JsonResponse {
    $categories = $doctrine->getRepository(Category::class)->findAll();
    $categories_json = [];

    foreach ($categories as $category) {
      $categories_json[] = [
        'name' => $category->getName()
      ];
    }

    return $this->json([$categories_json]);
  }

  #[Route('/category/{id}', name: 'app_category_details', methods: 'get')]
  public function categoryDetails(ManagerRegistry $doctrine, $id): JsonResponse {
    $category = $doctrine->getRepository(Category::class)->findOneBy(["id" => $id]);
    $category_json = [
      'name' => $category->getName()
    ];

    return $this->json($category_json);
  }

  #[Route('/category/{id}', name: 'app_category_delete', methods: 'delete')]
  public function categoryDelete(ManagerRegistry $doctrine, $id): JsonResponse {
    $category = $doctrine->getRepository(Category::class)->findOneBy(["id" => $id]);
    $em = $doctrine->getManager();
    $em->remove($category);
    $em->flush();
    return $this->json(["Mensaje" => "Eliminado correctamente"]);
  }

  #[Route('/category/{id}', name: 'app_category_edit', methods: 'put')]
  public function categoryEdit(ManagerRegistry $doctrine, $id, Request $request): JsonResponse {
    $em = $doctrine->getManager();
    $category = $doctrine->getRepository(Category::class)->findOneBy(["id" => $id]);
    $data = $request->getContent();
    $category_stdClass = json_decode($data);

    $category->setName($category_stdClass->name);

    $em->persist($category);
    $em->flush();

    $category_json = [
      'name' => $category->getName()
    ];
    return $this->json([$category_json]);
  }
}
