<?php

namespace App\Entity;

use App\Repository\FamillesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FamillesRepository::class)]
class Familles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Animaux>
     */
    #[ORM\OneToMany(targetEntity: Animaux::class, mappedBy: 'famille')]
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
            $animaux->setFamille($this);
        }

        return $this;
    }

    public function removeAnimaux(Animaux $animaux): static
    {
        if ($this->animaux->removeElement($animaux)) {
            // set the owning side to null (unless already changed)
            if ($animaux->getFamille() === $this) {
                $animaux->setFamille(null);
            }
        }

        return $this;
    }
}
