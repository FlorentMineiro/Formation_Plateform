<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
//use Webmozart\Assert\Assert;

#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
class Inscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'apprenant')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $apprenant = null;

    #[ORM\ManyToOne(inversedBy: 'formation')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Formation $formation = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateInscription = null;

    #[ORM\Column(length: 20)]
    #[Assert\Choice(
        choices:['En cours','Terminee','Abandonne'],
        message:"Le message doit être 'En cours','Terminee','Abandonnee'"
    )]
    private ?string $statut = null;

    #[ORM\Column]
    #[Assert\Length(
        min:0,
        max:100,
        minMessage:'Le pourcentage ne doit pas être en dessous de {{limit}}.',
        maxMessage:'Le pourcentage ne doit pas dépasser {{limit}} .'
    )]
    private ?int $progressionPourcentage = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $dateFin = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 20, nullable: true)]
    private ?string $note = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApprenant(): ?Utilisateur
    {
        return $this->apprenant;
    }

    public function setApprenant(?Utilisateur $apprenant): static
    {
        $this->apprenant = $apprenant;

        return $this;
    }

    public function getFormation(): ?Formation
    {
        return $this->formation;
    }

    public function setFormation(?Formation $formation): static
    {
        $this->formation = $formation;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeImmutable
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeImmutable $dateInscription): static
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getProgressionPourcentage(): ?int
    {
        return $this->progressionPourcentage;
    }

    public function setProgressionPourcentage(int $progressionPourcentage): static
    {
        $this->progressionPourcentage = $progressionPourcentage;

        return $this;
    }

    public function getDateFin(): ?\DateTime
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTime $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): static
    {
        $this->note = $note;

        return $this;
    }
}
