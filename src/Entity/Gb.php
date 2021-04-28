<?php

namespace App\Entity;

use App\Repository\GbRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GbRepository::class)
 */
class Gb
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
     * @ORM\ManyToOne(targetEntity=Company::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $company;

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

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

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
}
