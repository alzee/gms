<?php

namespace App\Entity;

use App\Repository\CgdRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CgdRepository::class)
 */
class Cgd
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Main::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $main;

    /**
     * @ORM\ManyToOne(targetEntity=Goldclass::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $goldclass;

    /**
     * @ORM\ManyToOne(targetEntity=Position::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $position;

    /**
     * @ORM\Column(type="float")
     */
    private $weight;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $note;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMain(): ?Center
    {
        return $this->main;
    }

    public function setMain(?Center $main): self
    {
        $this->main = $main;

        return $this;
    }

    public function getGoldclass(): ?Goldclass
    {
        return $this->goldclass;
    }

    public function setGoldclass(?Goldclass $goldclass): self
    {
        $this->goldclass = $goldclass;

        return $this;
    }

    public function getPosition(): ?Position
    {
        return $this->position;
    }

    public function setPosition(?Position $position): self
    {
        $this->position = $position;

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

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;

        return $this;
    }
}
