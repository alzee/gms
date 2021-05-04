<?php

namespace App\Entity;

use App\Repository\CaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CaRepository::class)
 */
class Ca
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

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

    /**
     * @ORM\ManyToOne(targetEntity=Child::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $child;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getChild(): ?Child
    {
        return $this->child;
    }

    public function setChild(?Child $child): self
    {
        $this->child = $child;

        return $this;
    }
}
