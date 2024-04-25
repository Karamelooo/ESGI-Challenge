<?php

namespace App\Entity;

use App\Repository\ServicesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServicesRepository::class)]
class Services
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\Column(nullable: true)]
    private ?int $selling_price = null;

    #[ORM\Column(nullable: true)]
    private ?int $purchase_price = null;

    #[ORM\Column(nullable: true)]
    private ?int $tax = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $last_update = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getSellingPrice(): ?int
    {
        return $this->selling_price;
    }

    public function setSellingPrice(?int $selling_price): static
    {
        $this->selling_price = $selling_price;

        return $this;
    }

    public function getPurchasePrice(): ?int
    {
        return $this->purchase_price;
    }

    public function setPurchasePrice(?int $purchase_price): static
    {
        $this->purchase_price = $purchase_price;

        return $this;
    }

    public function getTax(): ?int
    {
        return $this->tax;
    }

    public function setTax(?int $tax): static
    {
        $this->tax = $tax;

        return $this;
    }

    public function getLastUpdate(): ?\DateTimeInterface
    {
        return $this->last_update;
    }

    public function setLastUpdate(\DateTimeInterface $last_update): static
    {
        $this->last_update = $last_update;

        return $this;
    }
}
