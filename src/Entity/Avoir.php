<?php

namespace App\Entity;

use App\Repository\AvoirRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AvoirRepository::class)
 */
class Avoir
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_artcile;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_mot_cle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdArtcile(): ?int
    {
        return $this->id_artcile;
    }

    public function setIdArtcile(int $id_artcile): self
    {
        $this->id_artcile = $id_artcile;

        return $this;
    }

    public function getIdMotCle(): ?int
    {
        return $this->id_mot_cle;
    }

    public function setIdMotCle(int $id_mot_cle): self
    {
        $this->id_mot_cle = $id_mot_cle;

        return $this;
    }
}
