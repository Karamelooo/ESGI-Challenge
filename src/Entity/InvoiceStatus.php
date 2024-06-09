<?php

namespace App\Entity;

use App\Repository\InvoiceStatusRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoiceStatusRepository::class)]
class InvoiceStatus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'status')]
    private ?Invoices $invoices = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getInvoices(): ?Invoices
    {
        return $this->invoices;
    }

    public function setInvoices(?Invoices $invoices): static
    {
        $this->invoices = $invoices;

        return $this;
    }
}
