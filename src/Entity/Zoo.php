<?php

namespace App\Entity;

use App\Repository\ZooRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ZooRepository::class)]
class Zoo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $localisation = null;

    /**
     * @var Collection<int, Animaux>
     */
    #[ORM\OneToMany(targetEntity: Animaux::class, mappedBy: 'zoo')]
    private Collection $animaux;

    public function __construct()
    {
        $this->animaux = new ArrayCollection();
    }

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

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): static
    {
        $this->localisation = $localisation;

        return $this;
    }

    /**
     * @return Collection<int, Animaux>
     */
    public function getAnimaux(): Collection
    {
        return $this->animaux;
    }

    public function addAnimaux(Animaux $animaux): static
    {
        if (!$this->animaux->contains($animaux)) {
            $this->animaux->add($animaux);
            $animaux->setZoo($this);
        }

        return $this;
    }

    public function removeAnimaux(Animaux $animaux): static
    {
        if ($this->animaux->removeElement($animaux)) {
            // set the owning side to null (unless already changed)
            if ($animaux->getZoo() === $this) {
                $animaux->setZoo(null);
            }
        }

        return $this;
    }
}
