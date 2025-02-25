<?php

namespace App\Entity;

use App\Dto\UserRequestDto;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 500)]
    private ?string $password = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function __construct(UserRequestDto $dto =null, string $email =null, string $password=null) {
if($dto===null){
$this->email=$email;
$this->password=$password;
}else{
    $this->email = $dto->email;
    $this->password = $dto->password;
return;
}
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials(): void {
    }
    
    /**
     * @inheritDoc
     */
    public function getRoles(): array {
        return array();
    }
    
    /**
     * @inheritDoc
     */
    public function getUserIdentifier(): string {
        return $this->email;
    }
}