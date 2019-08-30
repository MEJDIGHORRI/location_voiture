<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VehiculeRepository")
 */
class Vehicule
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $immatriculation;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $model;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Location", mappedBy="vehicule")
     */
    private $rental;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rental", mappedBy="vehicule")
     */
    private $rentals;

    public function __construct()
    {
        $this->rental = new ArrayCollection();
        $this->rentals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImmatriculation(): ?string
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(?string $immatriculation): self
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): self
    {
        $this->model = $model;

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
            $rental->setVehicule($this);
        }

        return $this;
    }

    public function removeRental(Location $rental): self
    {
        if ($this->rental->contains($rental)) {
            $this->rental->removeElement($rental);
            // set the owning side to null (unless already changed)
            if ($rental->getVehicule() === $this) {
                $rental->setVehicule(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Rental[]
     */
    public function getRentals(): Collection
    {
        return $this->rentals;
    }
}
