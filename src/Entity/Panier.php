<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PanierRepository::class)]
class Panier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'paniers')]
    private ?User $User = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $cree_le = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $total = null;

    /**
     * @var Collection<int, ItemPanier>
     */
    #[ORM\OneToMany(targetEntity: ItemPanier::class, mappedBy: 'Panier')]
    private Collection $itemPaniers;

    public function __construct()
    {
        $this->itemPaniers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): static
    {
        $this->User = $User;

        return $this;
    }

    public function getCreeLe(): ?\DateTimeInterface
    {
        return $this->cree_le;
    }

    public function setCreeLe(\DateTimeInterface $cree_le): static
    {
        $this->cree_le = $cree_le;

        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(string $total): static
    {
        $this->total = $total;

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
            $itemPanier->setPanier($this);
        }

        return $this;
    }

    public function removeItemPanier(ItemPanier $itemPanier): static
    {
        if ($this->itemPaniers->removeElement($itemPanier)) {
            // set the owning side to null (unless already changed)
            if ($itemPanier->getPanier() === $this) {
                $itemPanier->setPanier(null);
            }
        }

        return $this;
    }
}
