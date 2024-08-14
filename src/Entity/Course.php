<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
class Course
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Subject = null;

    /**
     * @var Collection<int, Teachers>
     */
    #[ORM\OneToMany(targetEntity: Teachers::class, mappedBy: 'course')]
    private Collection $teacher;

    #[ORM\ManyToOne(inversedBy: 'Course')]
    private ?Students $students = null;

    #[ORM\ManyToOne(inversedBy: 'Course')]
    private ?Classes $classes = null;

    public function __construct()
    {
        $this->teacher = new ArrayCollection();
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

    public function getSubject(): ?string
    {
        return $this->Subject;
    }

    public function setSubject(string $Subject): static
    {
        $this->Subject = $Subject;

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
            $teacher->setCourse($this);
        }

        return $this;
    }

    public function removeTeacher(Teachers $teacher): static
    {
        if ($this->teacher->removeElement($teacher)) {
            // set the owning side to null (unless already changed)
            if ($teacher->getCourse() === $this) {
                $teacher->setCourse(null);
            }
        }

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
