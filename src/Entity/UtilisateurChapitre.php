<?php

namespace App\Entity;

use App\Repository\UtilisateurChapitreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurChapitreRepository::class)]
class UtilisateurChapitre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $utilisateurChapitreDateInscription = null;

    #[ORM\Column]
    private ?int $utilisateurChapitreTermine = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateurChapitreDateInscription(): ?\DateTimeInterface
    {
        return $this->utilisateurChapitreDateInscription;
    }

    public function setUtilisateurChapitreDateInscription(\DateTimeInterface $utilisateurChapitreDateInscription): self
    {
        $this->utilisateurChapitreDateInscription = $utilisateurChapitreDateInscription;

        return $this;
    }

    public function getUtilisateurChapitreTermine(): ?int
    {
        return $this->utilisateurChapitreTermine;
    }

    public function setUtilisateurChapitreTermine(int $utilisateurChapitreTermine): self
    {
        $this->utilisateurChapitreTermine = $utilisateurChapitreTermine;

        return $this;
    }
}
