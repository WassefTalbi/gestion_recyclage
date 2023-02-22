<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use symfony\component\validator\constraints as Assert;
/**
 * Post
 *
 * @ORM\Table(name="post", indexes={@ORM\Index(name="id_user", columns={"id_user"})})
 * @ORM\Entity
 */
class Post
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_post", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPost;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    
     #[Assert\Length(min:3)]
     #[Assert\Length(max:100)]
     #[Assert\NotBlank (message:"veuillez saisir la descripttion de l'association que vous voulez !! ")]
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="url_img", type="string", length=255, nullable=false)
     */
    private $urlImg;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=false)
     */
    #[Assert\Length(min:3)]
     #[Assert\Length(max:10)]
     #[Assert\NotBlank (message:"veuillez saisir le titre de l'association!! ")]
    private $titre;

    /**
     * @var int
     *
     * @ORM\Column(name="active", type="integer", nullable=false)
     */
    private $active;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     * })
     */
    private $idUser;

    public function getIdPost(): ?int
    {
        return $this->idPost;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getUrlImg()
    {
        return $this->urlImg;
    }

    public function setUrlImg($urlImg)
    {
        $this->urlImg = $urlImg;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getActive(): ?int
    {
        return $this->active;
    }

    public function setActive(int $active): self
    {
        $this->active = $active;

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


}
