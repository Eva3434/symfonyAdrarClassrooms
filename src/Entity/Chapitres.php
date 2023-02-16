<?php

namespace App\Entity;

use App\Repository\ChapitresRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChapitresRepository::class)]
class Chapitres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $chapitreTitre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $chapitreContenu = null;

    #[ORM\Column]
    private ?int $chapitrePosition = null;

    #[ORM\ManyToOne(inversedBy: 'chapitres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cours $cours = null;


    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChapitreTitre(): ?string
    {
        return $this->chapitreTitre;
    }

    public function setChapitreTitre(string $chapitreTitre): self
    {
        $this->chapitreTitre = $chapitreTitre;

        return $this;
    }

    public function getChapitreContenu(): ?string
    {
        return $this->chapitreContenu;
    }

    public function setChapitreContenu(string $chapitreContenu): self
    {
        $this->chapitreContenu = $chapitreContenu;

        return $this;
    }

    public function getChapitrePosition(): ?int
    {
        return $this->chapitrePosition;
    }

    public function setChapitrePosition(int $chapitrePosition): self
    {
        $this->chapitrePosition = $chapitrePosition;

        return $this;
    }

    public function getCours(): ?Cours
    {
        return $this->cours;
    }

    public function setCours(?Cours $cours): self
    {
        $this->cours = $cours;

        return $this;
    }    

   
}
