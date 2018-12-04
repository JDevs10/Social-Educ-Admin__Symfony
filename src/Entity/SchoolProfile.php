<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SchoolProfile
 *
 * @ORM\Table(name="school_profile")
 * @ORM\Entity
 */
class SchoolProfile
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
     * @ORM\Column(name="Name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="SchoolEmail", type="string", length=255, nullable=false)
     */
    private $schoolemail;

    /**
     * @var string
     *
     * @ORM\Column(name="Phone", type="string", length=255, nullable=false)
     */
    private $phone;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSchoolemail(): ?string
    {
        return $this->schoolemail;
    }

    public function setSchoolemail(string $schoolemail): self
    {
        $this->schoolemail = $schoolemail;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

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
