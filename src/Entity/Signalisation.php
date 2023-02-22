<?php

namespace App\Entity;

use App\Repository\SignalisationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SignalisationRepository::class)]
class Signalisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private  $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'description is required')]
    #[Assert\Length(min: 8, minMessage: '8 caractere au minimum')]
    private  $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    
    private  $dateSignal = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'photo is required')]
    private  $urlphoto = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'ville is required')]
    #[Assert\Length(min: 4, minMessage: '4 caractere au minimum')]
    private  $ville = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'region is required')]
    #[Assert\Length(min: 4, minMessage: '4 caractere au minimum')]
    private  $region = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'rue is required')]
    #[Assert\Length(min: 4, minMessage: '4 caractere au minimum')]
    private $rue = null;

    #[ORM\Column(type: 'string', length: 255)]

    private  $lat = null;

    #[ORM\Column(type: 'string', length: 255)]

    private  $lon = null;

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



    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getLat(): ?string
    {
        return $this->lat;
    }

    public function setLat(string $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLon(): ?string
    {
        return $this->lon;
    }

    public function setLon(string $lon): self
    {
        $this->lon = $lon;

        return $this;
    }
}
