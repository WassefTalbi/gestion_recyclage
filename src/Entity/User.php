<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private  $id;

    #[ORM\Column(type: 'integer',unique:true)]
    private  $cin ;


    #[ORM\Column(type:'string',length: 55)]
    private $nom ;

    #[ORM\Column(type:'string',length: 55)]
    private  $prenom ;

    #[ORM\Column(type:'string',length: 255)]
    private  $urlphoto ;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCin(): ?int
    {
        return $this->cin;
    }

    public function setCin(int $cin): self
    {
        $this->cin = $cin;

        return $this;
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
