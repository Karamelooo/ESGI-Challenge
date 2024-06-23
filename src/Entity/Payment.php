<?php

namespace App\Entity;

use App\Repository\PaymentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentRepository::class)]
class Payment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $amount = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToMany(mappedBy: 'payment', targetEntity: PaymentMethod::class)]
    private Collection $method_id;

    public function __construct()
    {
        $this->method_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, PaymentMethod>
     */
    public function getMethodId(): Collection
    {
        return $this->method_id;
    }

    public function addMethodId(PaymentMethod $methodId): static
    {
        if (!$this->method_id->contains($methodId)) {
            $this->method_id->add($methodId);
            $methodId->setPayment($this);
        }

        return $this;
    }

    public function removeMethodId(PaymentMethod $methodId): static
    {
        if ($this->method_id->removeElement($methodId)) {
            // set the owning side to null (unless already changed)
            if ($methodId->getPayment() === $this) {
                $methodId->setPayment(null);
            }
        }

        return $this;
    }
}
