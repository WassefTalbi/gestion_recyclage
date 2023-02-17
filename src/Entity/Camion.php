<?php

namespace App\Entity;

use App\Repository\CamionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CamionRepository::class)]
class Camion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private  $id ;

    #[ORM\Column(type:'string',length: 100,unique:true)]
    #[Assert\NotBlank(message:'matricule is required')]
    #[Assert\Length(min:4,minMessage:'4 caractere au minimum')]
    private $matricule ;

    #[ORM\Column(type:'string',length: 175)]
    #[Assert\NotBlank(message:'marque is required')]
    #[Assert\Length(min:4,minMessage:'4 caractere au minimum')]
    private  $marque ;

    #[ORM\Column(type:'string',length: 255,nullable:true)]
    #[Assert\NotBlank(message:'photo is required')]
    private $urlphoto ;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

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
}
