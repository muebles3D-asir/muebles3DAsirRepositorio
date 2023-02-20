<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;



#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements PasswordAuthenticatedUserInterface {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\Column(length: 25)]
    private $username;

    #[ORM\Column(length: 500)]
    private  $password;

    #[ORM\Column(name: "is_active", type: "boolean")]
    private $isActive;

    public function __construct($username) {
        $this->isActive = true;
        $this->username = $username;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getSalt() {
        return null;
    }
    public function getPassword(): ?string {

        return $this->password;
    }


    public function setPassword($password) {
        $this->password = $password;
    }


    public function getRoles() {
        return array('ROLE_USER');
    }

    public function eraseCredentials() {
    }
}
