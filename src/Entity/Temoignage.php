<?php

namespace App\Entity;

use App\Repository\TemoignageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TemoignageRepository::class)]
class Temoignage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $Nom = null;

    #[ORM\Column(length: 50)]
    private ?string $Metier = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Commentaire = null;

    #[ORM\ManyToOne(inversedBy: 'temoignages')]
    private ?User $Relation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getMetier(): ?string
    {
        return $this->Metier;
    }

    public function setMetier(string $Metier): static
    {
        $this->Metier = $Metier;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->Commentaire;
    }

    public function setCommentaire(string $Commentaire): static
    {
        $this->Commentaire = $Commentaire;

        return $this;
    }

    public function getRelation(): ?User
    {
        return $this->Relation;
    }

    public function setRelation(?User $Relation): static
    {
        $this->Relation = $Relation;

        return $this;
    }
}
