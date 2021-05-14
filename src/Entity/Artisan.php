<?php

namespace App\Entity;

use App\Repository\ArtisanRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArtisanRepository::class)
 */
class Artisan
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $box = 0;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $wn;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getBox(): ?float
    {
        return $this->box;
    }

    public function setBox(float $box): self
    {
        $this->box = $box;

        return $this;
    }

    public function getWn(): ?string
    {
        return $this->wn;
    }

    public function setWn(?string $wn): self
    {
        $this->wn = $wn;

        return $this;
    }
}
