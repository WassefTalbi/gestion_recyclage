<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Charite
 *
 * @ORM\Table(name="charite")
 * @ORM\Entity
 */
class Charite
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_charite", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCharite;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_charite", type="string", length=255, nullable=false)
     */
    private $nomCharite;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu_charite", type="string", length=255, nullable=false)
     */
    private $lieuCharite;

    /**
     * @var string
     *
     * @ORM\Column(name="type_charite", type="string", length=255, nullable=false)
     */
    private $typeCharite;

    public function getIdCharite(): ?int
    {
        return $this->idCharite;
    }

    public function getNomCharite(): ?string
    {
        return $this->nomCharite;
    }

    public function setNomCharite(string $nomCharite): self
    {
        $this->nomCharite = $nomCharite;

        return $this;
    }

    public function getLieuCharite(): ?string
    {
        return $this->lieuCharite;
    }

    public function setLieuCharite(string $lieuCharite): self
    {
        $this->lieuCharite = $lieuCharite;

        return $this;
    }

    public function getTypeCharite(): ?string
    {
        return $this->typeCharite;
    }

    public function setTypeCharite(string $typeCharite): self
    {
        $this->typeCharite = $typeCharite;

        return $this;
    }


}
