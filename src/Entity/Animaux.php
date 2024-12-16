<?php

namespace App\Entity;

use App\Repository\AnimauxRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimauxRepository::class)]
class Animaux
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $dangereux = null;

    #[ORM\Column(length: 255)]
    private ?string $images = null;

    #[ORM\ManyToOne(inversedBy: 'animaux')]
    private ?Familles $famille = null;

    #[ORM\ManyToOne(inversedBy: 'animaux')]
    private ?Continents $continent = null;

    #[ORM\ManyToOne(inversedBy: 'animaux')]
    private ?Zoo $zoo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDangereux(): ?string
    {
        return $this->dangereux;
    }

    public function setDangereux(string $dangereux): static
    {
        $this->dangereux = $dangereux;

        return $this;
    }

    public function getImages(): ?string
    {
        return $this->images;
    }

    public function setImages(string $images): static
    {
        $this->images = $images;

        return $this;
    }

    public function getFamille(): ?Familles
    {
        return $this->famille;
    }

    public function setFamille(?Familles $famille): static
    {
        $this->famille = $famille;

        return $this;
    }

    public function getContinent(): ?Continents
    {
        return $this->continent;
    }

    public function setContinent(?Continents $continent): static
    {
        $this->continent = $continent;

        return $this;
    }

    public function getZoo(): ?Zoo
    {
        return $this->zoo;
    }

    public function setZoo(?Zoo $zoo): static
    {
        $this->zoo = $zoo;

        return $this;
    }
}
