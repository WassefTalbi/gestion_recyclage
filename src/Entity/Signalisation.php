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
    #[ORM\Column(type: 'integer')]
    private  $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private  $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private  $dateSignal = null;

    #[ORM\Column(type: 'string', length: 255)]
    private  $urlphoto = null;

    #[ORM\OneToOne(targetEntity: 'App\Entity\Adresse', cascade: ['persist', 'remove'])]
    private $adresse = null;

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

    public function getUrlphoto(): ?string
    {
        return $this->urlphoto;
    }

    public function setUrlphoto(string $urlphoto): self
    {
        $this->urlphoto = $urlphoto;

        return $this;
    }

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }
}
