<?php

namespace App\Entity;

use App\Repository\MotsclesRepository;
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
}
