<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class Categorie
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
     * @ORM\OneToMany(targetEntity="App\Entity\Document", mappedBy="categorie")
     */
    private $docs;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\SousCategorie", inversedBy="y")
     */
    private $sousCategorie;

    public function __construct()
    {
       
        $this->docs = new ArrayCollection();
        $this->sousCategorie = new ArrayCollection();
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

  
    /**
     * @return Collection|Document[]
     */
    public function getDocs(): Collection
    {
        return $this->docs;
    }

    public function addDoc(Document $doc): self
    {
        if (!$this->docs->contains($doc)) {
            $this->docs[] = $doc;
            $doc->setCategorie($this);
        }

        return $this;
    }

    public function removeDoc(Document $doc): self
    {
        if ($this->docs->contains($doc)) {
            $this->docs->removeElement($doc);
            // set the owning side to null (unless already changed)
            if ($doc->getCategorie() === $this) {
                $doc->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SousCategorie[]
     */
    public function getSousCategorie(): Collection
    {
        return $this->sousCategorie;
    }

    public function addSousCategorie(SousCategorie $sousCategorie): self
    {
        if (!$this->sousCategorie->contains($sousCategorie)) {
            $this->sousCategorie[] = $sousCategorie;
        }

        return $this;
    }

    public function removeSousCategorie(SousCategorie $sousCategorie): self
    {
        if ($this->sousCategorie->contains($sousCategorie)) {
            $this->sousCategorie->removeElement($sousCategorie);
        }

        return $this;
    }
}
