<?php

namespace App\Entity;

use App\Repository\JobRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobRepository::class)]
class Job
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'job', targetEntity: Client::class, orphanRemoval: true)]
    private Collection $client;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $isActivated = null;

    #[ORM\Column(nullable: true)]
    private ?int $note = null;

    #[ORM\Column(length: 100)]
    private ?string $titleOffer = null;

    #[ORM\Column(length: 255)]
    private ?string $typeOffer = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\Column(length: 255)]
    private ?string $jobCategory = null;

    #[ORM\Column]
    private ?int $salary = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_At = null;

    #[ORM\OneToMany(mappedBy: 'job', targetEntity: Candidature::class)]
    private Collection $candidatures;

    public function __construct()
    {
        $this->client = new ArrayCollection();
        $this->candidatures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Client>
     */
    public function getClient(): Collection
    {
        return $this->client;
    }

    public function addClient(Client $client): static
    {
        if (!$this->client->contains($client)) {
            $this->client->add($client);
            $client->setJob($this);
        }

        return $this;
    }

    public function removeClient(Client $client): static
    {
        if ($this->client->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getJob() === $this) {
                $client->setJob(null);
            }
        }

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isIsActivated(): ?bool
    {
        return $this->isActivated;
    }

    public function setIsActivated(bool $isActivated): static
    {
        $this->isActivated = $isActivated;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getTitleOffer(): ?string
    {
        return $this->titleOffer;
    }

    public function setTitleOffer(string $titleOffer): static
    {
        $this->titleOffer = $titleOffer;

        return $this;
    }

    public function getTypeOffer(): ?string
    {
        return $this->typeOffer;
    }

    public function setTypeOffer(string $typeOffer): static
    {
        $this->typeOffer = $typeOffer;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getJobCategory(): ?string
    {
        return $this->jobCategory;
    }

    public function setJobCategory(string $jobCategory): static
    {
        $this->jobCategory = $jobCategory;

        return $this;
    }

    public function getSalary(): ?int
    {
        return $this->salary;
    }

    public function setSalary(int $salary): static
    {
        $this->salary = $salary;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_At;
    }

    public function setCreatedAt(\DateTimeImmutable $created_At): static
    {
        $this->created_At = $created_At;

        return $this;
    }

    public function getCandidature(): ?Candidature
    {
        return $this->candidature;
    }

    public function setCandidature(?Candidature $candidature): static
    {
        $this->candidature = $candidature;

        return $this;
    }

    /**
     * @return Collection<int, Candidature>
     */
    public function getCandidatures(): Collection
    {
        return $this->candidatures;
    }

    public function addCandidature(Candidature $candidature): static
    {
        if (!$this->candidatures->contains($candidature)) {
            $this->candidatures->add($candidature);
            $candidature->setJob($this);
        }

        return $this;
    }

    public function removeCandidature(Candidature $candidature): static
    {
        if ($this->candidatures->removeElement($candidature)) {
            // set the owning side to null (unless already changed)
            if ($candidature->getJob() === $this) {
                $candidature->setJob(null);
            }
        }

        return $this;
    }
}
