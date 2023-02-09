<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category {
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  private ?string $name = null;

  #[ORM\ManyToMany(targetEntity: Furniture::class, mappedBy: 'categories')]
  private Collection $furniture;

  public function __construct() {
    $this->furniture = new ArrayCollection();
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

  /**
   * @return Collection<int, Furniture>
   */
  public function getFurniture(): Collection {
    return $this->furniture;
  }

  public function addFurniture(Furniture $furniture): self {
    if (!$this->furniture->contains($furniture)) {
      $this->furniture->add($furniture);
      $furniture->addCategory($this);
    }

    return $this;
  }

  public function removeFurniture(Furniture $furniture): self {
    if ($this->furniture->removeElement($furniture)) {
      $furniture->removeCategory($this);
    }

    return $this;
  }
}
