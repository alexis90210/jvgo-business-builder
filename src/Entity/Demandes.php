<?php

namespace App\Entity;

use App\Repository\DemandesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandesRepository::class)]
class Demandes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $Civilite = null;

    #[ORM\Column(length: 255)]
    private ?string $Email = null;

    #[ORM\Column(length: 255)]
    private ?string $Structure = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $NomStructure = null;

    #[ORM\Column(length: 255)]
    private ?string $Formule = null;

    #[ORM\Column(length: 255)]
    private ?string $Montant = null;

    #[ORM\Column(length: 255)]
    private ?string $DateCreation = null;

    #[ORM\Column(length: 255)]
    private ?string $DelaiCreation = null;

    #[ORM\Column(length: 255)]
    private ?string $TypeEntreprise = null;

    #[ORM\Column(length: 255)]
    private ?string $TypeAbonnement = null;

    #[ORM\Column(length: 255)]
    private ?string $EntrepriseOrCompta = null;

    #[ORM\Column(length: 255)]
    private ?string $Status = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Mobile = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getCivilite(): ?string
    {
        return $this->Civilite;
    }

    public function setCivilite(string $Civilite): self
    {
        $this->Civilite = $Civilite;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getStructure(): ?string
    {
        return $this->Structure;
    }

    public function setStructure(string $Structure): self
    {
        $this->Structure = $Structure;

        return $this;
    }

    public function getNomStructure(): ?string
    {
        return $this->NomStructure;
    }

    public function setNomStructure(?string $NomStructure): self
    {
        $this->NomStructure = $NomStructure;

        return $this;
    }

    public function getFormule(): ?string
    {
        return $this->Formule;
    }

    public function setFormule(string $Formule): self
    {
        $this->Formule = $Formule;

        return $this;
    }

    public function getMontant(): ?string
    {
        return $this->Montant;
    }

    public function setMontant(string $Montant): self
    {
        $this->Montant = $Montant;

        return $this;
    }

    public function getDateCreation(): ?string
    {
        return $this->DateCreation;
    }

    public function setDateCreation(string $DateCreation): self
    {
        $this->DateCreation = $DateCreation;

        return $this;
    }

    public function getDelaiCreation(): ?string
    {
        return $this->DelaiCreation;
    }

    public function setDelaiCreation(string $DelaiCreation): self
    {
        $this->DelaiCreation = $DelaiCreation;

        return $this;
    }

    public function getTypeEntreprise(): ?string
    {
        return $this->TypeEntreprise;
    }

    public function setTypeEntreprise(string $TypeEntreprise): self
    {
        $this->TypeEntreprise = $TypeEntreprise;

        return $this;
    }

    public function getTypeAbonnement(): ?string
    {
        return $this->TypeAbonnement;
    }

    public function setTypeAbonnement(string $TypeAbonnement): self
    {
        $this->TypeAbonnement = $TypeAbonnement;

        return $this;
    }

    public function getEntrepriseOrCompta(): ?string
    {
        return $this->EntrepriseOrCompta;
    }

    public function setEntrepriseOrCompta(string $EntrepriseOrCompta): self
    {
        $this->EntrepriseOrCompta = $EntrepriseOrCompta;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->Status;
    }

    public function setStatus(string $Status): self
    {
        $this->Status = $Status;

        return $this;
    }

    public function getMobile(): ?string
    {
        return $this->Mobile;
    }

    public function setMobile(?string $Mobile): self
    {
        $this->Mobile = $Mobile;

        return $this;
    }
}
