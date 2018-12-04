<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Skills
 *
 * @ORM\Table(name="skills", indexes={@ORM\Index(name="ForeignKey_IdStudent_skills", columns={"IdStudent"})})
 * @ORM\Entity
 */
class Skills
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
     * @ORM\Column(name="SkillName", type="string", length=255, nullable=false)
     */
    private $skillname;

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

    public function getSkillname(): ?string
    {
        return $this->skillname;
    }

    public function setSkillname(string $skillname): self
    {
        $this->skillname = $skillname;

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
