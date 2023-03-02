<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * Bac
 *
 * @ORM\Table(name="bac")
 * @ORM\Entity
 */
class Bac
{
    /**
     * @var int
     *@Groups({"groups", "bac"})
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @Assert\NotBlank(message=" referance  est obligatoire")
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un referance au mini de 5 caracteres"
     *
     *     )
     * @var string
    *@Groups({"groups", "bac"})
     * @ORM\Column(name="ref", type="string", length=255, nullable=false)
     */
    private $ref;

    /**
     * @Assert\NotBlank(message=" adresse est obligatoire")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un adresse au mini de 5 caracteres"
     *
     *     )
     * @var string
     *@Groups({"groups", "bac"})
     * @ORM\Column(name="adresse", type="string", length=255, nullable=false)
     */
    private $adresse;

    /**
     * @Assert\NotBlank(message=" codepostal  est obligatoire")
     * @Assert\Type(type="integer")
     * @var int
     *@Groups({"groups", "bac"})
     * @ORM\Column(name="codepostal", type="integer", nullable=false)
     */
    private $codepostal;

    /**
     * @Assert\NotBlank(message=" capacite  est obligatoire")
     * @Assert\Type(type="integer")
     * @var int
     *@Groups({"groups", "bac"})
     * @ORM\Column(name="capacite", type="integer", nullable=false)
     */
    private $capacite;

    /**
     * @Assert\NotBlank(message=" etat  est obligatoire")
     * @Assert\Type(type="integer")
     * @var int
     *@Groups({"groups", "bac"})
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodepostal(): ?int
    {
        return $this->codepostal;
    }

    public function setCodepostal(int $codepostal): self
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    public function setCapacite(int $capacite): self
    {
        $this->capacite = $capacite;

        return $this;
    }

    public function getEtat(): ?int
    {
        return $this->etat;
    }

    public function setEtat(int $etat): self
    {
        $this->etat = $etat;

        return $this;
    }
    public function __toString() {
        $int = $this->id;
        $var1 = (string) $int; 
        
        return $var1;
    }
}
