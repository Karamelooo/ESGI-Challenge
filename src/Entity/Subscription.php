<?php

namespace App\Entity;

use App\Repository\SubscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubscriptionRepository::class)]
class Subscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'subscriptions')]
    private ?compagny $compagny_subcription = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $start_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $end_date = null;

    #[ORM\OneToMany(mappedBy: 'subscription', targetEntity: formule::class)]
    private Collection $formule;

    public function __construct()
    {
        $this->formule = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompagnySubcription(): ?compagny
    {
        return $this->compagny_subcription;
    }

    public function setCompagnySubcription(?compagny $compagny_subcription): static
    {
        $this->compagny_subcription = $compagny_subcription;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): static
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeInterface $end_date): static
    {
        $this->end_date = $end_date;

        return $this;
    }

    /**
     * @return Collection<int, formule>
     */
    public function getFormule(): Collection
    {
        return $this->formule;
    }

    public function addFormule(formule $formule): static
    {
        if (!$this->formule->contains($formule)) {
            $this->formule->add($formule);
            $formule->setSubscription($this);
        }

        return $this;
    }

    public function removeFormule(formule $formule): static
    {
        if ($this->formule->removeElement($formule)) {
            // set the owning side to null (unless already changed)
            if ($formule->getSubscription() === $this) {
                $formule->setSubscription(null);
            }
        }

        return $this;
    }
}
