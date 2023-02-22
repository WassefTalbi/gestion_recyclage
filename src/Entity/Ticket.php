<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $Prix = null;

    #[ORM\Column(nullable: true)]
    private ?int $Quantite = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Type = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $CreatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'tickets')]
    private ?Evenement $Evenement = null;

    #[ORM\ManyToOne(inversedBy: 'ticket')]
    private ?User $ticket = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?int
    {
        return $this->Prix;
    }

    public function setPrix(?int $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->Quantite;
    }

    public function setQuantite(?int $Quantite): self
    {
        $this->Quantite = $Quantite;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(?string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    public function getEvenement(): ?Evenement
    {
        return $this->Evenement;
    }

    public function setEvenement(?Evenement $Evenement): self
    {
        $this->Evenement = $Evenement;

        return $this;
    }

    public function getTicket(): ?User
    {
        return $this->ticket;
    }

    public function setTicket(?User $ticket): self
    {
        $this->ticket = $ticket;

        return $this;
    }
}

