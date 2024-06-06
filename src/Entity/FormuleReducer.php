<?php

namespace App\Entity;

use App\Repository\FormuleReducerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormuleReducerRepository::class)]
class FormuleReducer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'formuleReducer', targetEntity: formule::class)]
    private Collection $Formule;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $start_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $end_date = null;

    #[ORM\Column]
    private ?float $value = null;

    public function __construct()
    {
        $this->Formule = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, formule>
     */
    public function getFormule(): Collection
    {
        return $this->Formule;
    }

    public function addFormule(formule $formule): static
    {
        if (!$this->Formule->contains($formule)) {
            $this->Formule->add($formule);
            $formule->setFormuleReducer($this);
        }

        return $this;
    }

    public function removeFormule(formule $formule): static
    {
        if ($this->Formule->removeElement($formule)) {
            // set the owning side to null (unless already changed)
            if ($formule->getFormuleReducer() === $this) {
                $formule->setFormuleReducer(null);
            }
        }

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

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): static
    {
        $this->value = $value;

        return $this;
    }
}
