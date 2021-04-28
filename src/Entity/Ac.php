<?php

namespace App\Entity;

use App\Repository\AcRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AcRepository::class)
 */
class Ac
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Center::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $maindoc;

    /**
     * @ORM\ManyToOne(targetEntity=Artisan::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $artisan;

    /**
     * @ORM\Column(type="float")
     */
    private $weight;

    /**
     * @ORM\Column(type="float")
     */
    private $weightAttach;

    /**
     * @ORM\Column(type="float")
     */
    private $weightGold;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Craft::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $craft;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMaindoc(): ?Center
    {
        return $this->maindoc;
    }

    public function setMaindoc(?Center $maindoc): self
    {
        $this->maindoc = $maindoc;

        return $this;
    }

    public function getArtisan(): ?Artisan
    {
        return $this->artisan;
    }

    public function setArtisan(?Artisan $artisan): self
    {
        $this->artisan = $artisan;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getWeightAttach(): ?float
    {
        return $this->weightAttach;
    }

    public function setWeightAttach(float $weightAttach): self
    {
        $this->weightAttach = $weightAttach;

        return $this;
    }

    public function getWeightGold(): ?float
    {
        return $this->weightGold;
    }

    public function setWeightGold(float $weightGold): self
    {
        $this->weightGold = $weightGold;

        return $this;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCraft(): ?Craft
    {
        return $this->craft;
    }

    public function setCraft(?Craft $craft): self
    {
        $this->craft = $craft;

        return $this;
    }
}
