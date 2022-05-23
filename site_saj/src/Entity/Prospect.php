<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\ProspectRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ProspectRepository::class)]
/**
 * @Vich\Uploadable
 */
class Prospect
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    /**
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Votre nom ne peut pas contenir de chiffre"
     * )
     */

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    /**
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Votre prenom ne peut pas contenir de chiffre"
     * )
     */

    #[ORM\Column(type: 'string', length: 255)]
    private $prenom;
    /**
     * @Assert\Email(
     *     message = "l'adresse email '{{ value }}' est incorrect."
     * )
     */

    #[ORM\Column(type: 'string', length: 255)]
    private $email;


    #[ORM\Column(type: 'string', length: 255)]
    private $telephone;

    #[ORM\Column(type: 'text')]
    private $demandeDeDevis;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;


    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getDemandeDeDevis(): ?string
    {
        return $this->demandeDeDevis;
    }

    public function setDemandeDeDevis(string $demandeDeDevis): self
    {
        $this->demandeDeDevis = $demandeDeDevis;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
