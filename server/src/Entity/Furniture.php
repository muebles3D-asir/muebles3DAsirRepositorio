<?php

namespace App\Entity;

use App\Repository\FurnitureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FurnitureRepository::class)]
class Furniture {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column]
    private ?int $rating = null;

    #[ORM\Column(length: 255)]
    private ?string $shortDescription = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY)]
    private array $categories = [];

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    private ?string $filamento = null;

    #[ORM\Column(length: 255)]
    private ?string $color = null;

    #[ORM\Column(length: 255)]
    private ?string $material = null;

    #[ORM\Column]
    private ?float $tamaño = null;

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float {
        return $this->price;
    }

    public function setPrice(float $price): self {
        $this->price = $price;

        return $this;
    }

    public function getRating(): ?int {
        return $this->rating;
    }

    public function setRating(int $rating): self {
        $this->rating = $rating;

        return $this;
    }

    public function getShortDescription(): ?string {
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): self {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(string $description): self {
        $this->description = $description;

        return $this;
    }

    public function getCategories(): array {
        return $this->categories;
    }

    public function setCategories(array $categories): self {
        $this->categories = $categories;

        return $this;
    }

    public function getImage(): ?string {
        return $this->image;
    }

    public function setImage(string $image): self {
        $this->image = $image;

        return $this;
    }

    public function getTamaño(): ?float {
        return $this->tamaño;
    }

    public function setTamaño(float $tamaño): self {
        $this->tamaño = $tamaño;

        return $this;
    }

    public function getMaterial(): ?string {
        return $this->material;
    }

    public function setMaterial(string $material): self {
        $this->material = $material;

        return $this;
    }

    public function getColor(): ?string {
        return $this->color;
    }

    public function setColor(string $color): self {
        $this->color = $color;

        return $this;
    }

    public function getFilamento(): ?string {
        return $this->filamento;
    }

    public function setFilamento(string $filamento): self {
        $this->filamento = $filamento;

        return $this;
    }

}
