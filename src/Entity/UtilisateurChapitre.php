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
    private ?\DateTimeInterface $utilisateur_chapitre_date_inscription = null;

    #[ORM\Column]
    private ?int $utilisateur_chapitre_termine = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateurChapitreDateInscription(): ?\DateTimeInterface
    {
        return $this->utilisateur_chapitre_date_inscription;
    }

    public function setUtilisateurChapitreDateInscription(\DateTimeInterface $utilisateur_chapitre_date_inscription): self
    {
        $this->utilisateur_chapitre_date_inscription = $utilisateur_chapitre_date_inscription;

        return $this;
    }

    public function getUtilisateurChapitreTermine(): ?int
    {
        return $this->utilisateur_chapitre_termine;
    }

    public function setUtilisateurChapitreTermine(int $utilisateur_chapitre_termine): self
    {
        $this->utilisateur_chapitre_termine = $utilisateur_chapitre_termine;

        return $this;
    }
}
