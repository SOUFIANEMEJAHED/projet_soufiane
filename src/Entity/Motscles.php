<?php

namespace App\Entity;

use App\Repository\MotsclesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MotsclesRepository::class)
 */
class Motscles
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
    private $motcle;

    /**
     * @ORM\ManyToMany(targetEntity=Article::class, mappedBy="motscles")
     */
    private $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotcle(): ?string
    {
        return $this->motcle;
    }

    public function setMotcle(?string $motcle): self
    {
        $this->motcle = $motcle;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->addMotscle($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            $article->removeMotscle($this);
        }

        return $this;
    }

    public function __toString()
    {
        return __CLASS__;
    }
}
