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
<<<<<<< HEAD
    private ?int $invoice_number = 0;
=======
    private ?string $invoice_number = null;
>>>>>>> 55d33bb (feat(invoice): add invoice & invoiceStatus)

    public function getId(): ?int
    {
        return $this->id;
    }

<<<<<<< HEAD
    public function getInvoiceNumber(): ?int
=======
    public function getInvoiceNumber(): ?string
>>>>>>> 55d33bb (feat(invoice): add invoice & invoiceStatus)
    {
        return $this->invoice_number;
    }

<<<<<<< HEAD
    public function setInvoiceNumber(?int $invoice_number): static
=======
    public function setInvoiceNumber(string $invoice_number): static
>>>>>>> 55d33bb (feat(invoice): add invoice & invoiceStatus)
    {
        $this->invoice_number = $invoice_number;

        return $this;
    }
<<<<<<< HEAD
    
    public function __toString(): string
    {
        return $this->invoice_number;
    }
=======
>>>>>>> 55d33bb (feat(invoice): add invoice & invoiceStatus)
}
