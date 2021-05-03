<?php

namespace App\Entity;

use App\Repository\MainRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MainRepository::class)
 */
class Main
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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="smallint")
     */
    private $countChild;

    /**
     * @ORM\ManyToOne(targetEntity=Doctype::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $doctype;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $sn;

    /**
     * @ORM\ManyToOne(targetEntity=Prodtype::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $prodtype;

    /**
     * @ORM\ManyToOne(targetEntity=Goldclass::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $goldclass;

    /**
     * @ORM\Column(type="float")
     */
    private $perWeight;

    /**
     * @ORM\Column(type="float")
     */
    private $totalWeight;

    /**
     * @ORM\ManyToOne(targetEntity=Cotype::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $cotype;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $upstreamDoc;

    /**
     * @ORM\ManyToOne(targetEntity=Model::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $model;

    /**
     * @ORM\ManyToOne(targetEntity=Lossrate::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $lossRate;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $length;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $width;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $height;

    /**
     * @ORM\ManyToOne(targetEntity=Factory::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $factory;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity=Branch::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $branch;

    /**
     * @ORM\Column(type="smallint")
     */
    private $countPiece;

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
        return $this->sn;
    }

    public function getCountChild(): ?int
    {
        return $this->countChild;
    }

    public function setCountChild(int $countChild): self
    {
        $this->countChild = $countChild;

        return $this;
    }

    public function getDoctype(): ?Doctype
    {
        return $this->doctype;
    }

    public function setDoctype(?Doctype $doctype): self
    {
        $this->doctype = $doctype;

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

    public function getProdtype(): ?Prodtype
    {
        return $this->prodtype;
    }

    public function setProdtype(?Prodtype $prodtype): self
    {
        $this->prodtype = $prodtype;

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

    public function getPerWeight(): ?float
    {
        return $this->perWeight;
    }

    public function setPerWeight(float $perWeight): self
    {
        $this->perWeight = $perWeight;

        return $this;
    }

    public function getTotalWeight(): ?float
    {
        return $this->totalWeight;
    }

    public function setTotalWeight(float $totalWeight): self
    {
        $this->totalWeight = $totalWeight;

        return $this;
    }

    public function getCotype(): ?Cotype
    {
        return $this->cotype;
    }

    public function setCotype(?Cotype $cotype): self
    {
        $this->cotype = $cotype;

        return $this;
    }

    public function getUpstreamDoc(): ?string
    {
        return $this->upstreamDoc;
    }

    public function setUpstreamDoc(string $upstreamDoc): self
    {
        $this->upstreamDoc = $upstreamDoc;

        return $this;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(?Model $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getLossRate(): ?Lossrate
    {
        return $this->lossRate;
    }

    public function setLossRate(?Lossrate $lossRate): self
    {
        $this->lossRate = $lossRate;

        return $this;
    }

    public function getLength(): ?float
    {
        return $this->length;
    }

    public function setLength(?float $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getWidth(): ?float
    {
        return $this->width;
    }

    public function setWidth(?float $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(?float $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getFactory(): ?Factory
    {
        return $this->factory;
    }

    public function setFactory(?Factory $factory): self
    {
        $this->factory = $factory;

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

    public function getBranch(): ?Branch
    {
        return $this->branch;
    }

    public function setBranch(?Branch $branch): self
    {
        $this->branch = $branch;

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
}