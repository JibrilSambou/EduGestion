<?php

namespace App\Entity;

use App\Repository\TeachersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeachersRepository::class)]
class Teachers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $User = null;

    #[ORM\ManyToOne(inversedBy: 'teacher')]
    private ?Course $course = null;

    #[ORM\ManyToOne(inversedBy: 'teachers')]
    private ?Students $students = null;

    #[ORM\ManyToOne(inversedBy: 'teacher')]
    private ?Schedules $schedules = null;

    #[ORM\ManyToOne(inversedBy: 'Teacher')]
    private ?Classes $classes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): static
    {
        $this->User = $User;

        return $this;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(?Course $course): static
    {
        $this->course = $course;

        return $this;
    }

    public function getStudents(): ?Students
    {
        return $this->students;
    }

    public function setStudents(?Students $students): static
    {
        $this->students = $students;

        return $this;
    }

    public function getSchedules(): ?Schedules
    {
        return $this->schedules;
    }

    public function setSchedules(?Schedules $schedules): static
    {
        $this->schedules = $schedules;

        return $this;
    }

    public function getClasses(): ?Classes
    {
        return $this->classes;
    }

    public function setClasses(?Classes $classes): static
    {
        $this->classes = $classes;

        return $this;
    }
}
