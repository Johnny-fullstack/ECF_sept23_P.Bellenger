<?php

namespace App\Entity;

use App\Repository\ReservationsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
#[ORM\Entity(repositoryClass: ReservationsRepository::class)]
class Reservations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[ORM\Column()]
    private ?int $nbpers = null;

    #[Assert\NotBlank]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $jour = null;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $heure_dej = null;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $heure_diner = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $allergies = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbpers(): ?int
    {
        return $this->nbpers;
    }

    public function setNbpers(?int $nbpers): self
    {
        $this->nbpers = $nbpers;

        return $this;
    }

    public function getJour(): ?\DateTimeInterface
    {
        return $this->jour;
    }

    public function setJour(?\DateTimeInterface $jour): self
    {
        $this->jour = $jour;

        return $this;
    }

    public function getHeureDej(): ?\DateTimeInterface
    {
        return $this->heure_dej;
    }

    public function setHeureDej(?\DateTimeInterface $heure_dej): self
    {
        $this->heure_dej = $heure_dej;

        return $this;
    }

    public function getHeureDiner(): ?\DateTimeInterface
    {
        return $this->heure_diner;
    }

    public function setHeureDiner(?\DateTimeInterface $heure_diner): self
    {
        $this->heure_diner = $heure_diner;

        return $this;
    }

    public function getAllergies(): ?string
    {
        return $this->allergies;
    }

    public function setAllergies(?string $allergies): self
    {
        $this->allergies = $allergies;

        return $this;
    }
}
