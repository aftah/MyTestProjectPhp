<?php

namespace App\Trait;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait TimeStampTrait
{
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTime $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTime $updatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $detetedAt = null;


    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDetetedAt(): ?\DateTime
    {
        return $this->detetedAt;
    }

    public function setDetetedAt(?\DateTimeImmutable $detetedAt): static
    {
        $this->detetedAt = $detetedAt;

        return $this;
    }


    #[ORM\PrePersist]
    public function OnPrePersist()
    {
        $this->createdAt = new \DateTime();
    }

    #[ORM\PreUpdate]
    public function OnPreUpdate()
    {
        $this->updatedAt = new \DateTime();
    }
}