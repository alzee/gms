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

    /**
     * @ORM\ManyToOne(targetEntity=Addtype::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $addtype;

    /**
     * @ORM\ManyToOne(targetEntity=Addreason::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $addreason;

    /**
     * @ORM\Column(type="float")
     */
    private $weightBooked;

    /**
     * @ORM\Column(type="float")
     */
    private $weight;

    /**
     * @ORM\Column(type="float")
     */
    private $short;

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

    public function getAddtype(): ?Addtype
    {
        return $this->addtype;
    }

    public function setAddtype(?Addtype $addtype): self
    {
        $this->addtype = $addtype;

        return $this;
    }

    public function getAddreason(): ?Addreason
    {
        return $this->addreason;
    }

    public function setAddreason(?Addreason $addreason): self
    {
        $this->addreason = $addreason;

        return $this;
    }

    public function getWeightBooked(): ?float
    {
        return $this->weightBooked;
    }

    public function setWeightBooked(float $weightBooked): self
    {
        $this->weightBooked = $weightBooked;

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

    public function getShort(): ?float
    {
        return $this->short;
    }

    public function setShort(float $short): self
    {
        $this->short = $short;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }
}
