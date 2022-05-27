<?php

namespace App\Entity;

use App\Repository\DepannageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepannageRepository::class)]
class Depannage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\ManyToOne(targetEntity: Prospect::class, inversedBy: 'depannage')]
    private $prospect;

    #[ORM\Column(type: 'string', length: 255)]
    private $typeDePorte;

    #[ORM\Column(type: 'string', length: 255)]
    private $typeDeMotorisation;


    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $numeroDeMotorisation;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nomDeEntreprise;

    #[ORM\Column(type: 'string', length: 255)]
    private $prenom;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getProspect(): ?Prospect
    {
        return $this->prospect;
    }

    public function setProspect(?Prospect $prospect): self
    {
        $this->prospect = $prospect;

        return $this;
    }

    public function getTypeDePorte(): ?string
    {
        return $this->typeDePorte;
    }

    public function setTypeDePorte(string $typeDePorte): self
    {
        $this->typeDePorte = $typeDePorte;

        return $this;
    }

    public function getTypeDeMotorisation(): ?string
    {
        return $this->typeDeMotorisation;
    }

    public function setTypeDeMotorisation(string $typeDeMotorisation): self
    {
        $this->typeDeMotorisation = $typeDeMotorisation;

        return $this;
    }


    public function getNumeroDeMotorisation(): ?string
    {
        return $this->numeroDeMotorisation;
    }

    public function setNumeroDeMotorisation(?string $numeroDeMotorisation): self
    {
        $this->numeroDeMotorisation = $numeroDeMotorisation;

        return $this;
    }

    public function __toString(): string
    {
        return $this->prospect;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNomDeEntreprise(): ?string
    {
        return $this->nomDeEntreprise;
    }

    public function setNomDeEntreprise(?string $nomDeEntreprise): self
    {
        $this->nomDeEntreprise = $nomDeEntreprise;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }
}

