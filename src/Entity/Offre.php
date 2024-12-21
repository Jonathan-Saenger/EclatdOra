<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffreRepository::class)]
class Offre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Titre_offre = null;

    #[ORM\Column]
    private ?int $duree_offre = null;

    #[ORM\Column]
    private ?float $prix_offre = null;

    /**
     * @var Collection<int, ItemPanier>
     */
    #[ORM\OneToMany(targetEntity: ItemPanier::class, mappedBy: 'Offre')]
    private Collection $itemPaniers;

    public function __construct()
    {
        $this->itemPaniers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreOffre(): ?string
    {
        return $this->Titre_offre;
    }

    public function setTitreOffre(string $Titre_offre): static
    {
        $this->Titre_offre = $Titre_offre;

        return $this;
    }

    public function getDureeOffre(): ?int
    {
        return $this->duree_offre;
    }

    public function setDureeOffre(int $duree_offre): static
    {
        $this->duree_offre = $duree_offre;

        return $this;
    }

    public function getPrixOffre(): ?float
    {
        return $this->prix_offre;
    }

    public function setPrixOffre(float $prix_offre): static
    {
        $this->prix_offre = $prix_offre;

        return $this;
    }

    /**
     * @return Collection<int, ItemPanier>
     */
    public function getItemPaniers(): Collection
    {
        return $this->itemPaniers;
    }

    public function addItemPanier(ItemPanier $itemPanier): static
    {
        if (!$this->itemPaniers->contains($itemPanier)) {
            $this->itemPaniers->add($itemPanier);
            $itemPanier->setOffre($this);
        }

        return $this;
    }

    public function removeItemPanier(ItemPanier $itemPanier): static
    {
        if ($this->itemPaniers->removeElement($itemPanier)) {
            // set the owning side to null (unless already changed)
            if ($itemPanier->getOffre() === $this) {
                $itemPanier->setOffre(null);
            }
        }

        return $this;
    }
}
