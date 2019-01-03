<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
//, indexes={@ORM\Index(name="ForeignKey_IdStudent_experience", columns={"IdStudent"})}
/**
 * Experience
 *
 * @ORM\Table(name="experience")
 * @ORM\Entity
 */
class Experience
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
     * @ORM\Column(name="Title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="CompanyName", type="string", length=255, nullable=false)
     */
    private $companyname;

    /**
     * @var string
     *
     * @ORM\Column(name="CompanyAddress", type="string", length=255, nullable=false)
     */
    private $companyaddress;

    /**
     * @var string
     *
     * @ORM\Column(name="CompanyWebSite", type="string", length=255, nullable=false)
     */
    private $companywebsite;

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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCompanyname(): ?string
    {
        return $this->companyname;
    }

    public function setCompanyname(string $companyname): self
    {
        $this->companyname = $companyname;

        return $this;
    }

    public function getCompanyaddress(): ?string
    {
        return $this->companyaddress;
    }

    public function setCompanyaddress(string $companyaddress): self
    {
        $this->companyaddress = $companyaddress;

        return $this;
    }

    public function getCompanywebsite(): ?string
    {
        return $this->companywebsite;
    }

    public function setCompanywebsite(string $companywebsite): self
    {
        $this->companywebsite = $companywebsite;

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
