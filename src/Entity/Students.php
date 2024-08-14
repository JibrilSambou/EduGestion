<?php

namespace App\Entity;

use App\Repository\StudentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentsRepository::class)]
class Students
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(length: 255)]
    private ?string $Classe = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Birthday = null;

    /**
     * @var Collection<int, Teachers>
     */
    #[ORM\OneToMany(targetEntity: Teachers::class, mappedBy: 'students')]
    private Collection $teachers;

    /**
     * @var Collection<int, Course>
     */
    #[ORM\OneToMany(targetEntity: Course::class, mappedBy: 'students')]
    private Collection $Course;

    #[ORM\ManyToOne(inversedBy: 'Student')]
    private ?Payments $payments = null;

    #[ORM\ManyToOne(inversedBy: 'Student')]
    private ?Schedules $schedules = null;

    #[ORM\ManyToOne(inversedBy: 'Student')]
    private ?Classes $classes = null;

    public function __construct()
    {
        $this->teachers = new ArrayCollection();
        $this->Course = new ArrayCollection();
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

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getClasse(): ?string
    {
        return $this->Classe;
    }

    public function setClasse(string $Classe): static
    {
        $this->Classe = $Classe;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->Birthday;
    }

    public function setBirthday(\DateTimeInterface $Birthday): static
    {
        $this->Birthday = $Birthday;

        return $this;
    }

    /**
     * @return Collection<int, Teachers>
     */
    public function getTeachers(): Collection
    {
        return $this->teachers;
    }

    public function addTeacher(Teachers $teacher): static
    {
        if (!$this->teachers->contains($teacher)) {
            $this->teachers->add($teacher);
            $teacher->setStudents($this);
        }

        return $this;
    }

    public function removeTeacher(Teachers $teacher): static
    {
        if ($this->teachers->removeElement($teacher)) {
            // set the owning side to null (unless already changed)
            if ($teacher->getStudents() === $this) {
                $teacher->setStudents(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Course>
     */
    public function getCourse(): Collection
    {
        return $this->Course;
    }

    public function addCourse(Course $course): static
    {
        if (!$this->Course->contains($course)) {
            $this->Course->add($course);
            $course->setStudents($this);
        }

        return $this;
    }

    public function removeCourse(Course $course): static
    {
        if ($this->Course->removeElement($course)) {
            // set the owning side to null (unless already changed)
            if ($course->getStudents() === $this) {
                $course->setStudents(null);
            }
        }

        return $this;
    }

    public function getPayments(): ?Payments
    {
        return $this->payments;
    }

    public function setPayments(?Payments $payments): static
    {
        $this->payments = $payments;

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
