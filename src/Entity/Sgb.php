<?php

namespace App\Entity;

use App\Repository\SgbRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SgbRepository::class)
 */
class Sgb
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
     * @ORM\ManyToOne(targetEntity=Subtracttype::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $subtracttype;

    /**
     * @ORM\ManyToOne(targetEntity=Subtractreason::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $subtractreason;

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

    public function getSubtracttype(): ?Subtracttype
    {
        return $this->subtracttype;
    }

    public function setSubtracttype(?Subtracttype $subtracttype): self
    {
        $this->subtracttype = $subtracttype;

        return $this;
    }

    public function getSubtractreason(): ?Subtractreason
    {
        return $this->subtractreason;
    }

    public function setSubtractreason(?Subtractreason $subtractreason): self
    {
        $this->subtractreason = $subtractreason;

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
