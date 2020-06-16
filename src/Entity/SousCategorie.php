<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SousCategorieRepository")
 */
class SousCategorie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="categories")
     */
    private $categorie;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Categorie", mappedBy="sousCategorie")
     */
    private $y;

    public function __construct()
    {
        $this->y = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getY(): Collection
    {
        return $this->y;
    }

    public function addY(Categorie $y): self
    {
        if (!$this->y->contains($y)) {
            $this->y[] = $y;
            $y->addSousCategorie($this);
        }

        return $this;
    }

    public function removeY(Categorie $y): self
    {
        if ($this->y->contains($y)) {
            $this->y->removeElement($y);
            $y->removeSousCategorie($this);
        }

        return $this;
    }
}
