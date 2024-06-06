<?php

namespace App\Entity;

use App\Repository\ServicesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
#[ORM\Entity(repositoryClass: ServicesRepository::class)]
class Services
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;
   
    #[ORM\Column(nullable: true)]
    private ?int $purchase_price = null;
    
    #[ORM\Column(nullable: true)]
    private ?int $selling_price = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $updated_at = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\Column(type: Types::GUID, unique: true)]
    private ?string $service_number = null;

    #[ORM\ManyToOne(inversedBy: 'services')]
    private ?Category $category = null;

    #[ORM\ManyToOne(inversedBy: 'services')]
    private ?Tax $tax = null;

    public function __construct()
    {
        $this->service_number = Uuid::uuid4()->toString();
    }
    
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

    public function getLastUpdate(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setLastUpdate(\DateTimeInterface $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getServiceNumber(): ?string
    {
        return $this->service_number;
    }

    public function setServiceNumber(string $service_number): static
    {
        $this->service_number = $service_number;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getTax(): ?Tax
    {
        return $this->tax;
    }

    public function setTax(?Tax $tax): static
    {
        $this->tax = $tax;

        return $this;
    }
}
