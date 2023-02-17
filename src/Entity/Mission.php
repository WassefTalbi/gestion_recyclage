<?php

namespace App\Entity;

use App\Repository\MissionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MissionRepository::class)]
class Mission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'description is required')]
    #[Assert\Length(min: 20, minMessage: '20 caractere au minimum')]
    private  $description;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: 'Date mission is required')]
    #[Assert\GreaterThanOrEqual("today", message: "Date mission cannot be in the past")]
    private  $dateMission;

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

    public function getDateMission(): ?\DateTimeInterface
    {
        return $this->dateMission;
    }

    public function setDateMission(\DateTimeInterface $dateMission): self
    {
        $this->dateMission = $dateMission;

        return $this;
    }
}
