<?php

namespace App\Entity;
//@ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="user_id", cascade={"persist"})
//* @ORM\JoinColumn(name="user_id", referencedColumnName="icustomer_id", onDelete="CASCADE")

use App\Repository\DeviceUsersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DeviceUsersRepository::class)
 * @ORM\Table(name="device_users")
 */
class DeviceUsers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $device_users_id;

    /**
     * @ORM\Column(type="integer")
     * 
     */
    private $user_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $device_id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $start_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $end_date;


    public function getDeviceUsersId(): ?int
    {
        return $this->device_users_id;
    }

    public function setDeviceUsersId(int $device_users_id): self
    {
        $this->device_users_id = $device_users_id;

        return $this;
    }
    

    public function getDeviceId(): ?int
    {
        return $this->device_id;
    }

    public function setDeviceId(int $device_id): self
    {
        $this->device_id = $device_id;

        return $this;
    }

    public function getUsersId(): ?int
    {
        return $this->user_id;
    }

    public function setUsersId(int $users_id): self
    {
        $this->users_id = $users_id;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(?\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(?\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }
}
