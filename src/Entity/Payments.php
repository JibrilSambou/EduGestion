<?php

namespace App\Entity;

use App\Repository\PaymentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentsRepository::class)]
class Payments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0)]
    private ?string $Amount = null;

    /**
     * @var Collection<int, Students>
     */
    #[ORM\OneToMany(targetEntity: Students::class, mappedBy: 'payments')]
    private Collection $Student;

    public function __construct()
    {
        $this->Student = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->Amount;
    }

    public function setAmount(string $Amount): static
    {
        $this->Amount = $Amount;

        return $this;
    }

    /**
     * @return Collection<int, Students>
     */
    public function getStudent(): Collection
    {
        return $this->Student;
    }

    public function addStudent(Students $student): static
    {
        if (!$this->Student->contains($student)) {
            $this->Student->add($student);
            $student->setPayments($this);
        }

        return $this;
    }

    public function removeStudent(Students $student): static
    {
        if ($this->Student->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getPayments() === $this) {
                $student->setPayments(null);
            }
        }

        return $this;
    }
}
