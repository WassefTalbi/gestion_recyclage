<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Don
 *
 * @ORM\Table(name="don", indexes={@ORM\Index(name="id_charite", columns={"id_charite"}), @ORM\Index(name="id_user", columns={"id_user"})})
 * @ORM\Entity
 */
class Don
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_dons", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDons;

    /**
     * @var string
     *
     * @ORM\Column(name="type_dons", type="string", length=255, nullable=false)
     */
    #[Assert\Length(min:3)]
     #[Assert\Length(max:10)]
     #[Assert\NotBlank (message:"veuillez saisir le type de dons ")]
    private $typeDons;

    /**
     * @var string
     *
     * @ORM\Column(name="description_dons", type="string", length=255, nullable=false)
     */
    private $descriptionDons;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     * })
     */
    private $idUser;

    /**
     * @var \Charite
     *
     * @ORM\ManyToOne(targetEntity="Charite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_charite", referencedColumnName="id_charite")
     * })
     */
    private $idCharite;

    public function getIdDons(): ?int
    {
        return $this->idDons;
    }

    public function getTypeDons(): ?string
    {
        return $this->typeDons;
    }

    public function setTypeDons(string $typeDons): self
    {
        $this->typeDons = $typeDons;

        return $this;
    }

    public function getDescriptionDons(): ?string
    {
        return $this->descriptionDons;
    }

    public function setDescriptionDons(string $descriptionDons): self
    {
        $this->descriptionDons = $descriptionDons;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdCharite(): ?Charite
    {
        return $this->idCharite;
    }

    public function setIdCharite(?Charite $idCharite): self
    {
        $this->idCharite = $idCharite;

        return $this;
    }


}
