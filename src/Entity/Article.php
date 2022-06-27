<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contenu;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_creation;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_modif;

   

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="article")
     */
    private $commentaires;

   

    /**
     * @ORM\ManyToMany(targetEntity=Motscles::class, inversedBy="articles")
     */
    private $motscles;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="teeeest")
     */
    private $utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="articlees")
     * @ORM\JoinColumn(nullable=true)
     */
    private $categorie;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->categorie = new ArrayCollection();
        $this->motscles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return __CLASS__;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(?string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getDateModif(): ?\DateTimeInterface
    {
        return $this->date_modif;
    }

    public function setDateModif(?\DateTimeInterface $date_modif): self
    {
        $this->date_modif = $date_modif;

        return $this;
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
            $commentaire->setArticle($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getArticle() === $this) {
                $commentaire->setArticle(null);
            }
        }

        return $this;
    }

    

    /**
     * @return Collection<int, Motscles>
     */
    public function getMotscles(): Collection
    {
        return $this->motscles;
    }

    public function addMotscle(Motscles $motscle): self
    {
        if (!$this->motscles->contains($motscle)) {
            $this->motscles[] = $motscle;
        }

        return $this;
    }

    public function removeMotscle(Motscles $motscle): self
    {
        $this->motscles->removeElement($motscle);

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getCategorie(): ?String
    {
        return $this->categorie;
        
    }


    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
}
