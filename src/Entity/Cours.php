<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $titre_cour = null;

    #[ORM\Column(length: 100)]
    private ?string $synopsis_cour = null;

    #[ORM\Column]
    private ?int $cour_niveau = null;

    #[ORM\Column]
    private ?int $temps_estime_cour = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $image_cour = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_cour = null;

    #[ORM\Column]
    private ?int $cree_cour = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreCour(): ?string
    {
        return $this->titre_cour;
    }

    public function setTitreCour(string $titre_cour): self
    {
        $this->titre_cour = $titre_cour;

        return $this;
    }

    public function getSynopsisCour(): ?string
    {
        return $this->synopsis_cour;
    }

    public function setSynopsisCour(string $synopsis_cour): self
    {
        $this->synopsis_cour = $synopsis_cour;

        return $this;
    }

    public function getCourNiveau(): ?int
    {
        return $this->cour_niveau;
    }

    public function setCourNiveau(int $cour_niveau): self
    {
        $this->cour_niveau = $cour_niveau;

        return $this;
    }

    public function getTempsEstimeCour(): ?int
    {
        return $this->temps_estime_cour;
    }

    public function setTempsEstimeCour(int $temps_estime_cour): self
    {
        $this->temps_estime_cour = $temps_estime_cour;

        return $this;
    }

    public function getImageCour(): ?string
    {
        return $this->image_cour;
    }

    public function setImageCour(?string $image_cour): self
    {
        $this->image_cour = $image_cour;

        return $this;
    }

    public function getDateCour(): ?\DateTimeInterface
    {
        return $this->date_cour;
    }

    public function setDateCour(\DateTimeInterface $date_cour): self
    {
        $this->date_cour = $date_cour;

        return $this;
    }

    public function getCreeCour(): ?int
    {
        return $this->cree_cour;
    }

    public function setCreeCour(int $cree_cour): self
    {
        $this->cree_cour = $cree_cour;

        return $this;
    }
}
