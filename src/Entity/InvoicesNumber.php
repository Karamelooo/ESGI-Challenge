<?php

namespace App\Entity;

use App\Repository\InvoicesNumberRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoicesNumberRepository::class)]
class InvoicesNumber
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?int $invoice_number = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvoiceNumber(): ?int
    {
        return $this->invoice_number;
    }

    public function setInvoiceNumber(?int $invoice_number): static

    {
        $this->invoice_number = $invoice_number;

        return $this;
    }
    
    public function __toString(): string
    {
        return $this->invoice_number;
    }

}
