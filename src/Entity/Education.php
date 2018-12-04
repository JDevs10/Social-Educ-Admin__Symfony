<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Education
 *
 * @ORM\Table(name="education", indexes={@ORM\Index(name="ForeignKey_IdStudent_education", columns={"IdStudent"})})
 * @ORM\Entity
 */
class Education
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="SchoolName", type="string", length=255, nullable=false)
     */
    private $schoolname;

    /**
     * @var string
     *
     * @ORM\Column(name="Diploma", type="string", length=255, nullable=false)
     */
    private $diploma;

    /**
     * @var string
     *
     * @ORM\Column(name="FieldOfStudy", type="string", length=255, nullable=false)
     */
    private $fieldofstudy;

    /**
     * @var string
     *
     * @ORM\Column(name="DiplomaLevel", type="string", length=255, nullable=false)
     */
    private $diplomalevel;

    /**
     * @var string
     *
     * @ORM\Column(name="Period", type="string", length=255, nullable=false)
     */
    private $period;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var \StudentProfile
     *
     * @ORM\ManyToOne(targetEntity="StudentProfile")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdStudent", referencedColumnName="id")
     * })
     */
    private $idstudent;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSchoolname(): ?string
    {
        return $this->schoolname;
    }

    public function setSchoolname(string $schoolname): self
    {
        $this->schoolname = $schoolname;

        return $this;
    }

    public function getDiploma(): ?string
    {
        return $this->diploma;
    }

    public function setDiploma(string $diploma): self
    {
        $this->diploma = $diploma;

        return $this;
    }

    public function getFieldofstudy(): ?string
    {
        return $this->fieldofstudy;
    }

    public function setFieldofstudy(string $fieldofstudy): self
    {
        $this->fieldofstudy = $fieldofstudy;

        return $this;
    }

    public function getDiplomalevel(): ?string
    {
        return $this->diplomalevel;
    }

    public function setDiplomalevel(string $diplomalevel): self
    {
        $this->diplomalevel = $diplomalevel;

        return $this;
    }

    public function getPeriod(): ?string
    {
        return $this->period;
    }

    public function setPeriod(string $period): self
    {
        $this->period = $period;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIdstudent(): ?StudentProfile
    {
        return $this->idstudent;
    }

    public function setIdstudent(?StudentProfile $idstudent): self
    {
        $this->idstudent = $idstudent;

        return $this;
    }


}
