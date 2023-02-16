<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private ?string $titreCour = null;

    #[ORM\Column(length: 100)]
    private ?string $synopsisCour = null;

    #[ORM\Column]
    private ?int $cour_niveau = null;

    #[ORM\Column]
    private ?int $temps_estimeCour = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $imageCour = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateCour = null;

    #[ORM\Column]
    private ?int $creeCour = null;

    #[ORM\OneToMany(mappedBy: 'cours', targetEntity: Chapitres::class, orphanRemoval: true)]
    private Collection $chapitres;

    public function __construct()
    {
        $this->chapitres = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreCour(): ?string
    {
        return $this->titreCour;
    }

    public function setTitreCour(string $titreCour): self
    {
        $this->titreCour = $titreCour;

        return $this;
    }

    public function getSynopsisCour(): ?string
    {
        return $this->synopsisCour;
    }

    public function setSynopsisCour(string $synopsisCour): self
    {
        $this->synopsisCour = $synopsisCour;

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
        return $this->temps_estimeCour;
    }

    public function setTempsEstimeCour(int $temps_estimeCour): self
    {
        $this->temps_estimeCour = $temps_estimeCour;

        return $this;
    }

    public function getImageCour(): ?string
    {
        return $this->imageCour;
    }

    public function setImageCour(?string $imageCour): self
    {
        $this->imageCour = $imageCour;

        return $this;
    }

    public function getDateCour(): ?\DateTimeInterface
    {
        return $this->dateCour;
    }

    public function setDateCour(\DateTimeInterface $dateCour): self
    {
        $this->dateCour = $dateCour;

        return $this;
    }

    public function getCreeCour(): ?int
    {
        return $this->creeCour;
    }

    public function setCreeCour(int $creeCour): self
    {
        $this->creeCour = $creeCour;

        return $this;
    }

    /**
     * @return Collection<int, Chapitres>
     */
    public function getChapitres(): Collection
    {
        return $this->chapitres;
    }

    public function addChapitre(Chapitres $chapitre): self
    {
        if (!$this->chapitres->contains($chapitre)) {
            $this->chapitres->add($chapitre);
            $chapitre->setCours($this);
        }

        return $this;
    }

    public function removeChapitre(Chapitres $chapitre): self
    {
        if ($this->chapitres->removeElement($chapitre)) {
            // set the owning side to null (unless already changed)
            if ($chapitre->getCours() === $this) {
                $chapitre->setCours(null);
            }
        }

        return $this;
    }

}
