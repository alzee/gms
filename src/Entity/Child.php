<?php

namespace App\Entity;

use App\Repository\ChildRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ApiFilter(SearchFilter::class, properties={"sn": "exact"})
 * @ORM\Entity(repositoryClass=ChildRepository::class)
 */
class Child
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
     * @ORM\ManyToOne(targetEntity=Goldclass::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $goldclass;

    /**
     * @ORM\Column(type="float")
     */
    private $weight;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity=Main::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $main;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $sn;

    /**
     * @ORM\Column(type="smallint")
     */
    private $countPiece;

    /**
     * @ORM\Column(type="float")
     */
    private $box = 0;

    /**
     * @ORM\ManyToOne(targetEntity=Artisan::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private $artisan;

    /**
     * @ORM\ManyToOne(targetEntity=Artisan::class)
     */
    private $holder;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $weightAttach;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $size;

    /**
     * @ORM\ManyToOne(targetEntity=Craft::class)
     */
    private $craft;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $model;

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

    public function getGoldclass(): ?Goldclass
    {
        return $this->goldclass;
    }

    public function setGoldclass(?Goldclass $goldclass): self
    {
        $this->goldclass = $goldclass;

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

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getMain(): ?Main
    {
        return $this->main;
    }

    public function setMain(?Main $main): self
    {
        $this->main = $main;

        return $this;
    }

    public function getSn(): ?string
    {
        return $this->sn;
    }

    public function setSn(string $sn): self
    {
        $this->sn = $sn;

        return $this;
    }

    public function __construct()
    {
        $this->date = new \DateTimeImmutable();
    }

    public function getCountPiece(): ?int
    {
        return $this->countPiece;
    }

    public function setCountPiece(int $countPiece): self
    {
        $this->countPiece = $countPiece;

        return $this;
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

    public function __toString(): string
    {
        return $this->sn;
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

    public function getHolder(): ?Artisan
    {
        return $this->holder;
    }

    public function setHolder(?Artisan $holder): self
    {
        $this->holder = $holder;

        return $this;
    }

    public function getWeightAttach(): ?float
    {
        return $this->weightAttach;
    }

    public function setWeightAttach(?float $weightAttach): self
    {
        $this->weightAttach = $weightAttach;

        return $this;
    }

    public function getSize(): ?float
    {
        return $this->size;
    }

    public function setSize(?float $size): self
    {
        $this->size = $size;

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

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): self
    {
        $this->model = $model;

        return $this;
    }
}
