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

    private $doc;

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
     * @ORM\JoinColumn(nullable=true)
     */
    private $child;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $clerk;

    /**
     * @ORM\Column(type="smallint")
     */
    private $status = 0;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $date1;

    /**
     * @ORM\ManyToOne(targetEntity=Main::class)
     */
    private $main;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $model;

    /**
     * @ORM\ManyToOne(targetEntity=Goldclass::class)
     */
    private $goldclass;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class)
     */
    private $team;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDoc(): ?string
    {
        return $this->doc;
    }

    public function setDoc(?string $doc): self
    {
        $this->doc= $doc;

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

    public function getChild(): ?Child
    {
        return $this->child;
    }

    public function setChild(?Child $child): self
    {
        $this->child = $child;

        return $this;
    }

    public function getClerk(): ?User
    {
        return $this->clerk;
    }

    public function setClerk(?User $clerk): self
    {
        $this->clerk = $clerk;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDate1(): ?\DateTimeImmutable
    {
        return $this->date1;
    }

    public function setDate1(?\DateTimeImmutable $date1): self
    {
        $this->date1 = $date1;

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

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): self
    {
        $this->model = $model;

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

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;

        return $this;
    }
}
