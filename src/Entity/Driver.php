<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DriverRepository")
 */
class Driver
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $phone_number;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Location", mappedBy="driver")
     */
    private $rental;

    public function __construct()
    {
        $this->rental = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(?string $phone_number): self
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    /**
     * @return Collection|Location[]
     */
    public function getRental(): Collection
    {
        return $this->rental;
    }

    public function addRental(Location $rental): self
    {
        if (!$this->rental->contains($rental)) {
            $this->rental[] = $rental;
            $rental->setDriver($this);
        }

        return $this;
    }

    public function removeRental(Location $rental): self
    {
        if ($this->rental->contains($rental)) {
            $this->rental->removeElement($rental);
            // set the owning side to null (unless already changed)
            if ($rental->getDriver() === $this) {
                $rental->setDriver(null);
            }
        }

        return $this;
    }
}
