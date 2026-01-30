<?php

namespace App\Entity;

use App\Repository\BatimentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BatimentRepository::class)]
class Batiment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\OneToOne(mappedBy: 'batiment', cascade: ['persist', 'remove'])]
    private ?Personne $personnes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getPersonnes(): ?Personne
    {
        return $this->personnes;
    }

    public function setPersonnes(?Personne $personnes): static
    {
        // unset the owning side of the relation if necessary
        if ($personnes === null && $this->personnes !== null) {
            $this->personnes->setBatiment(null);
        }

        // set the owning side of the relation if necessary
        if ($personnes !== null && $personnes->getBatiment() !== $this) {
            $personnes->setBatiment($this);
        }

        $this->personnes = $personnes;

        return $this;
    }
}
