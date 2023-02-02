<?php

namespace App\Entity;

use App\Repository\FurnitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

  #[ORM\Column(length: 255)]
  private ?string $image = null;

  #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'furniture')]
  private Collection $categories;

  public function __construct() {
    $this->categories = new ArrayCollection();
  }

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

  public function getImage(): ?string {
    return $this->image;
  }

  public function setImage(string $image): self {
    $this->image = $image;

    return $this;
  }

  /**
   * @return Collection<int, category>
   */
  public function getCategories(): Collection {
    return $this->categories;
  }

  public function addCategory(Category $category): self {
    if (!$this->categories->contains($category)) {
      $this->categories->add($category);
    }

    return $this;
  }

  public function removeCategory(Category $category): self {
    $this->categories->removeElement($category);

    return $this;
  }
}
