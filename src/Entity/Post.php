<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use symfony\component\validator\constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;


use App\Repository\PublicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Post
 *
 * @ORM\Table(name="post", indexes={@ORM\Index(name="id_user", columns={"id_user"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
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
    #[Groups("Post")]
    private $idPost;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
     #[Groups("Post")]
     #[Assert\Length(min:3)]
     #[Assert\Length(max:100)]
     #[Assert\NotBlank (message:"veuillez saisir la descripttion de l'association que vous voulez !! ")]
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
     #[Groups("Post")]
    private $date;
    
    /**
     * @var string
     *
     * @ORM\Column(name="url_img", type="string", length=255, nullable=true)
     */
     #[Groups("Post")]
    private $urlImg;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=false)
     */
     #[Groups("Post")]
     #[Assert\Length(min:3)]
     #[Assert\Length(max:10)]
     #[Assert\NotBlank (message:"veuillez saisir le titre de l'association!! ")]
    private $titre;

    /**
     * @var int
     *
     * @ORM\Column(name="active", type="integer", nullable=false)
     */
     #[Groups("Post")]
    private $active;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     * })
     */
     #[Groups("Post")]
    private $idUser;

     /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="idPost", cascade={"remove"})
     *
     */
    private $commentaires;
  
    function _construct() {
        $this->date=new \DateTime();
        $this->commentaires = new ArrayCollection();
    }

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

    /**
     * Summary of getIdUser
     * @return User|null
     */
    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }
    public function __construct()
    {
        $this->date = new \DateTime('now');
    }

     /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setIdPost($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getIdPost() === $this) {
                $commentaire->setIdpost(null);
            }
        }

        return $this;
    }
    /**
     * Summary of __toString
     * @return string
     */
    public function __toString()
    {
       return $this->titre;
    }

}
