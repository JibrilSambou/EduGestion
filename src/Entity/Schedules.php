<?php

namespace App\Entity;

use App\Repository\SchedulesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SchedulesRepository::class)]
class Schedules
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Date = null;

    /**
     * @var Collection<int, Teachers>
     */
    #[ORM\OneToMany(targetEntity: Teachers::class, mappedBy: 'schedules')]
    private Collection $teacher;

    /**
     * @var Collection<int, Students>
     */
    #[ORM\OneToMany(targetEntity: Students::class, mappedBy: 'schedules')]
    private Collection $Student;

    #[ORM\ManyToOne(inversedBy: 'Schedule')]
    private ?Classes $classes = null;

    public function __construct()
    {
        $this->teacher = new ArrayCollection();
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): static
    {
        $this->Date = $Date;

        return $this;
    }

    /**
     * @return Collection<int, Teachers>
     */
    public function getTeacher(): Collection
    {
        return $this->teacher;
    }

    public function addTeacher(Teachers $teacher): static
    {
        if (!$this->teacher->contains($teacher)) {
            $this->teacher->add($teacher);
            $teacher->setSchedules($this);
        }

        return $this;
    }

    public function removeTeacher(Teachers $teacher): static
    {
        if ($this->teacher->removeElement($teacher)) {
            // set the owning side to null (unless already changed)
            if ($teacher->getSchedules() === $this) {
                $teacher->setSchedules(null);
            }
        }

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
            $student->setSchedules($this);
        }

        return $this;
    }

    public function removeStudent(Students $student): static
    {
        if ($this->Student->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getSchedules() === $this) {
                $student->setSchedules(null);
            }
        }

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
