<?php

namespace App\Entity;

use App\Repository\InvoicesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoicesRepository::class)]
class Invoices
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Compagny::class, inversedBy: 'invoices')]
    private ?Compagny $company = null; // Compagnie qui envoie la facture

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $last_payment_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $last_send_date = null;  // Date de la dernière relance

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $due_date = null; // Date d'échéance

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $update_at = null; // Date de la dernière modification TODO: dois servir à la gestion des archives

    #[ORM\OneToMany(mappedBy: 'invoices', targetEntity: InvoiceStatus::class)]
    private Collection $status; // Brouillon, Devis, Facture

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null; // Date de création (NE DOIT PAS CHANGER)

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?InvoicesNumber $invoices_number = null;    // Numéro de invoice (NE DOIT PAS CHANGER)
                                                        // TODO: Initial du Status + invoicesNumber = Numéro de brouillon/devis/facture

    #[ORM\OneToMany(mappedBy: 'invoice', targetEntity: Order::class)]
    private Collection $orders;

    #[ORM\OneToMany(mappedBy: 'invoices', targetEntity: Payment::class)]
    private Collection $payments;

    #[ORM\ManyToOne(inversedBy: 'invoices')]
    private ?Client $client = null;

    public function __construct()
    {
        $this->status = new ArrayCollection();
        $this->orders = new ArrayCollection();
        $this->payments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompany(): ?Compagny
    {
        return $this->company;
    }

    public function setCompany(?Compagny $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getLastPaymentDate(): ?\DateTimeInterface
    {
        return $this->last_payment_date;
    }

    public function setLastPaymentDate(?\DateTimeInterface $last_payment_date): static
    {
        $this->last_payment_date = $last_payment_date;

        return $this;
    }

    public function getLastSendDate(): ?\DateTimeInterface
    {
        return $this->last_send_date;
    }

    public function setLastSendDate(?\DateTimeInterface $last_send_date): static
    {
        $this->last_send_date = $last_send_date;

        return $this;
    }

    public function getDueDate(): ?\DateTimeInterface
    {
        return $this->due_date;
    }

    public function setDueDate(?\DateTimeInterface $due_date): static
    {
        $this->due_date = $due_date;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->update_at;
    }

    public function setUpdateAt(\DateTimeInterface $update_at): static
    {
        $this->update_at = $update_at;

        return $this;
    }

    /**
     * @return Collection<int, InvoiceStatus>
     */
    public function getStatus(): Collection
    {
        return $this->status;
    }

    public function addStatus(InvoiceStatus $status): static
    {
        if (!$this->status->contains($status)) {
            $this->status->add($status);
            $status->setInvoices($this);
        }

        return $this;
    }

    public function removeStatus(InvoiceStatus $status): static
    {
        if ($this->status->removeElement($status)) {
            // set the owning side to null (unless already changed)
            if ($status->getInvoices() === $this) {
                $status->setInvoices(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getInvoicesNumber(): ?InvoicesNumber
    {
        return $this->invoices_number;
    }

    public function setInvoicesNumber(EntityManagerInterface $entityManager): static
    {
        if ($this->invoices_number === null) {
            $invoiceNumber = new InvoicesNumber();
            $invoiceNumber->setInvoiceNumber(1);

            $entityManager->persist($invoiceNumber);
            $entityManager->flush();

            $this->invoices_number = $invoiceNumber;
            return $this;
        }
        $this->invoices_number->nextInvoicesNumber();

        return $this;
    }

    public function nextInvoicesNumber(): static
    {
        $invoiceNumber = $this->invoices_number;
        $this->invoices_number = $invoiceNumber+1;
        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): static
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->setInvoice($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): static
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getInvoice() === $this) {
                $order->setInvoice(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return 'Invoice ' . $this->id;
    }

    /**
     * @return Collection<int, Payment>
     */
    public function getPayments(): Collection
    {
        return $this->payments;
    }

    public function addPayment(Payment $payment): static
    {
        if (!$this->payments->contains($payment)) {
            $this->payments->add($payment);
            $payment->setInvoices($this);
        }

        return $this;
    }

    public function removePayment(Payment $payment): static
    {
        if ($this->payments->removeElement($payment)) {
            // set the owning side to null (unless already changed)
            if ($payment->getInvoices() === $this) {
                $payment->setInvoices(null);
            }
        }

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

}
