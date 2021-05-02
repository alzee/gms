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
        return $this->name;
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
}
