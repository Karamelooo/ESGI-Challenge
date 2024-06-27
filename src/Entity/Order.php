<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?Invoices $invoice = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?Services $service = null;

    #[ORM\Column(nullable: true)]
    private ?int $reducer = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?Tax $tax = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvoice(): ?Invoices
    {
        return $this->invoice;
    }

    public function setInvoice(?Invoices $invoice): static
    {
        $this->invoice = $invoice;

        return $this;
    }

    public function getService(): ?Services
    {
        return $this->service;
    }

    public function setService(?Services $service): static
    {
        $this->service = $service;

        return $this;
    }

    public function getReducer(): ?int
    {
        return $this->reducer;
    }

    public function setReducer(?int $reducer): static
    {
        $this->reducer = $reducer;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): static
    {
        $this->quantity = $quantity;

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
