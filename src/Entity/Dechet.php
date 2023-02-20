<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Bac;
use App\Entity\Categorie;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Dechet
 *
 * @ORM\Table(name="dechet", indexes={@ORM\Index(name="fk1", columns={"id_bac"}), @ORM\Index(name="f_2", columns={"id_cat"})})
 * @ORM\Entity
 */
class Dechet
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @Assert\NotBlank(message=" quantite  est obligatoire")
     * @Assert\Type(type="integer")
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity=Categorie::class)
     * @ORM\JoinColumn(nullable=false)
     * })
     */
    private $idCat;

    /**
     * @var \Bac
     *
     * @ORM\ManyToOne(targetEntity=Bac::class)
     * @ORM\JoinColumn(nullable=false)
     * })
     */

     
    private $idBac;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function id_cat(): ?Categorie
    {
        return $this->idCat;
    }

    public function getIdCat(): ?Categorie
    {
        return $this->idCat;
    }
    public function setIdCat(?Categorie $idCat): self
    {
        $this->idCat = $idCat;

        return $this;
    }

    

    public function getIdBac(): ?Bac
    {
        return $this->idBac;
    }
    public function id_bac(): ?Bac
    {
        return $this->idBac;
    }
    public function setIdBac(?Bac $idBac): self
    {
        $this->idBac = $idBac;

        return $this;
    }


}