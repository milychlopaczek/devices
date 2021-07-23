<?php

namespace App\Entity;

use App\Repository\DevicesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DevicesRepository::class)
 */
class Devices
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $device_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $companyName;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $expiry_date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;


    public function getDeviceId(): ?int
    {
        return $this->device_id;
    }

    public function setDeviceId(int $device_id): self
    {
        $this->device_id = $device_id;

        return $this;
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

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(?string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getExpiryDate(): ?\DateTimeInterface
    {
        return $this->expiry_date;
    }

    public function setExpiryDate(?\DateTimeInterface $expiry_date): self
    {
        $this->expiry_date = $expiry_date;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
