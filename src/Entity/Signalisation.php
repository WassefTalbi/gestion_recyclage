<?php

namespace App\Entity;

use App\Repository\SignalisationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SignalisationRepository::class)]
class Signalisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateSignal = null;

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

    public function getDateSignal(): ?\DateTimeInterface
    {
        return $this->dateSignal;
    }

    public function setDateSignal(\DateTimeInterface $dateSignal): self
    {
        $this->dateSignal = $dateSignal;

        return $this;
    }
}
