<?php

namespace App\Entity;

use App\Repository\CompagnyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;

#[ORM\Entity(repositoryClass: CompagnyRepository::class)]
class Compagny
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo_path = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adress = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $zip_code = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(nullable: true)]
    private ?string $siret = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $naf = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $website = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $capital = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\OneToMany(mappedBy: 'compagny_subcription', targetEntity: Subscription::class)]
    private Collection $subscriptions;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: Invoices::class)]
    private Collection $invoices;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: User::class)]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'compagny', targetEntity: Client::class)]
    private Collection $clients;

    public function __construct()
    {
        $this->subscriptions = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->invoices = new ArrayCollection();
        $this->clients = new ArrayCollection();
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

    public function getLogoPath(): ?string
    {
        return $this->logo_path;
    }

    public function setLogoPath(string $logo_path): static
    {
        $this->logo_path = $logo_path;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(?string $adress): static
    {
        $this->adress = $adress;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zip_code;
    }

    public function setZipCode(?string $zip_code): static
    {
        $this->zip_code = $zip_code;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getSiret(): ?int
    {
        return $this->siret;
    }

    public function setSiret(?int $siret): static
    {
        $this->siret = $siret;

        return $this;
    }

    public function getNaf(): ?string
    {
        return $this->naf;
    }

    public function setNaf(?string $naf): static
    {
        $this->naf = $naf;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): static
    {
        $this->website = $website;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCapital(): ?string
    {
        return $this->capital;
    }

    public function setCapital(?string $capital): static
    {
        $this->capital = $capital;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name . ' (' . $this->id . ')';
    }

    /**
     * @return Collection<int, Subscription>
     */
    public function getSubscriptions(): Collection
    {
        return $this->subscriptions;
    }

    public function addSubscription(Subscription $subscription): static
    {
        if (!$this->subscriptions->contains($subscription)) {
            $this->subscriptions->add($subscription);
            $subscription->setCompagnySubcription($this);
        }

        return $this;
    }

    public function removeSubscription(Subscription $subscription): static
    {
        if ($this->subscriptions->removeElement($subscription)) {
            // set the owning side to null (unless already changed)
            if ($subscription->getCompagnySubcription() === $this) {
                $subscription->setCompagnySubcription(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Invoices[]
     */
    public function getInvoices(): Collection
    {
        return $this->invoices;
    }

    public function addInvoice(Invoices $invoice): self
    {
        if (!$this->invoices->contains($invoice)) {
            $this->invoices[] = $invoice;
            $invoice->setCompany($this);
        }

        return $this;
    }

    public function removeInvoice(Invoices $invoice): self
    {
        if ($this->invoices->removeElement($invoice)) {
            // set the owning side to null (unless already changed)
            if ($invoice->getCompany() === $this) {
                $invoice->setCompany(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setCompany($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCompany() === $this) {
                $user->setCompany(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Client>
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): static
    {
        if (!$this->clients->contains($client)) {
            $this->clients->add($client);
            $client->setCompagny($this);
        }

        return $this;
    }

    public function removeClient(Client $client): static
    {
        if ($this->clients->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getCompagny() === $this) {
                $client->setCompagny(null);
            }
        }


        return $this;
    }
}
