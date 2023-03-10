<?php

namespace App\Entity;

use App\Repository\UtilisateursRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateursRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Utilisateurs implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 50)]
    private ?string $utilisateurNom = null;

    #[ORM\Column(length: 50)]
    private ?string $utilisateurPrenom = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $utilisateurImage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUtilisateurNom(): ?string
    {
        return $this->utilisateurNom;
    }

    public function setUtilisateurNom(string $utilisateurNom): self
    {
        $this->utilisateurNom = $utilisateurNom;

        return $this;
    }

    public function getUtilisateurPrenom(): ?string
    {
        return $this->utilisateurPrenom;
    }

    public function setUtilisateurPrenom(string $utilisateurPrenom): self
    {
        $this->utilisateurPrenom = $utilisateurPrenom;

        return $this;
    }

    public function getUtilisateurImage(): ?string
    {
        return $this->utilisateurImage;
    }

    public function setUtilisateurImage(?string $utilisateurImage): self
    {
        $this->utilisateurImage = $utilisateurImage;

        return $this;
    }
}
