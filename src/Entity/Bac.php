<?php

namespace App\Entity;

use App\Repository\BacRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BacRepository::class)]
class Bac
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:'integer')]
    private $id ;

    #[ORM\Column(type:'integer',unique:true)]
    private  $reference ;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?int
    {
        return $this->reference;
    }

    public function setReference(int $reference): self
    {
        $this->reference = $reference;

        return $this;
    }
}
