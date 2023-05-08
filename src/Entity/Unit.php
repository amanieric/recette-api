<?php

namespace App\Entity;

use App\Entity\Traits\HasIdTrait;
use App\Repository\UnitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UnitRepository::class)]
class Unit
{
    use HasIdTrait;

    #[ORM\Column(length: 128, nullable: true)]
    private ?string $singular = null;

    #[ORM\Column(length: 128, nullable: true)]
    private ?string $plural = null;


    public function getSingular(): ?string
    {
        return $this->singular;
    }

    public function setSingular(?string $singular): self
    {
        $this->singular = $singular;

        return $this;
    }

    public function getPlural(): ?string
    {
        return $this->plural;
    }

    public function setPlural(?string $plural): self
    {
        $this->plural = $plural;

        return $this;
    }
}
