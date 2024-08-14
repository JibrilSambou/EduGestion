<?php

namespace App\Entity;

use App\Repository\ClassesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassesRepository::class)]
class Classes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $level = null;

    /**
     * @var Collection<int, Students>
     */
    #[ORM\OneToMany(targetEntity: Students::class, mappedBy: 'classes')]
    private Collection $Student;

    /**
     * @var Collection<int, Teachers>
     */
    #[ORM\OneToMany(targetEntity: Teachers::class, mappedBy: 'classes')]
    private Collection $Teacher;

    /**
     * @var Collection<int, Course>
     */
    #[ORM\OneToMany(targetEntity: Course::class, mappedBy: 'classes')]
    private Collection $Course;

    /**
     * @var Collection<int, Schedules>
     */
    #[ORM\OneToMany(targetEntity: Schedules::class, mappedBy: 'classes')]
    private Collection $Schedule;

    public function __construct()
    {
        $this->Student = new ArrayCollection();
        $this->Teacher = new ArrayCollection();
        $this->Course = new ArrayCollection();
        $this->Schedule = new ArrayCollection();
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
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): static
    {
        $this->level = $level;

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
            $student->setClasses($this);
        }

        return $this;
    }

    public function removeStudent(Students $student): static
    {
        if ($this->Student->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getClasses() === $this) {
                $student->setClasses(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Teachers>
     */
    public function getTeacher(): Collection
    {
        return $this->Teacher;
    }

    public function addTeacher(Teachers $teacher): static
    {
        if (!$this->Teacher->contains($teacher)) {
            $this->Teacher->add($teacher);
            $teacher->setClasses($this);
        }

        return $this;
    }

    public function removeTeacher(Teachers $teacher): static
    {
        if ($this->Teacher->removeElement($teacher)) {
            // set the owning side to null (unless already changed)
            if ($teacher->getClasses() === $this) {
                $teacher->setClasses(null);
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
            $course->setClasses($this);
        }

        return $this;
    }

    public function removeCourse(Course $course): static
    {
        if ($this->Course->removeElement($course)) {
            // set the owning side to null (unless already changed)
            if ($course->getClasses() === $this) {
                $course->setClasses(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Schedules>
     */
    public function getSchedule(): Collection
    {
        return $this->Schedule;
    }

    public function addSchedule(Schedules $schedule): static
    {
        if (!$this->Schedule->contains($schedule)) {
            $this->Schedule->add($schedule);
            $schedule->setClasses($this);
        }

        return $this;
    }

    public function removeSchedule(Schedules $schedule): static
    {
        if ($this->Schedule->removeElement($schedule)) {
            // set the owning side to null (unless already changed)
            if ($schedule->getClasses() === $this) {
                $schedule->setClasses(null);
            }
        }

        return $this;
    }
}
