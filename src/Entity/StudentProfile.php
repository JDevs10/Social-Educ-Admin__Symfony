<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StudentProfile
 *
 * @ORM\Table(name="student_profile")
 * @ORM\Entity
 */
class StudentProfile
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
     * @ORM\Column(name="FirstName", type="string", length=255, nullable=false)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="LastName", type="string", length=255, nullable=false)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="sex", type="string", length=255, nullable=false)
     */
    private $sex;

    /**
     * @var int
     *
     * @ORM\Column(name="Age", type="integer", nullable=false)
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="LastDiploma", type="string", length=255, nullable=false)
     */
    private $lastdiploma;

    /**
     * @var string
     *
     * @ORM\Column(name="StreetAddress", type="string", length=255, nullable=false)
     */
    private $streetaddress;

    /**
     * @var string
     *
     * @ORM\Column(name="Country", type="string", length=255, nullable=false)
     */
    private $country;

    /**
     * @var int
     *
     * @ORM\Column(name="ZipCode", type="integer", nullable=false)
     */
    private $zipcode;

    /**
     * @var string
     *
     * @ORM\Column(name="Password", type="string", length=255, nullable=false)
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getLastdiploma(): ?string
    {
        return $this->lastdiploma;
    }

    public function setLastdiploma(string $lastdiploma): self
    {
        $this->lastdiploma = $lastdiploma;

        return $this;
    }

    public function getStreetaddress(): ?string
    {
        return $this->streetaddress;
    }

    public function setStreetaddress(string $streetaddress): self
    {
        $this->streetaddress = $streetaddress;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getZipcode(): ?int
    {
        return $this->zipcode;
    }

    public function setZipcode(int $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }


}
