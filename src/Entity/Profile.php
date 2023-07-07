<?php

namespace App\Entity;

use App\Repository\ProfileRepository;
use App\Trait\TimeStampTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfileRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Profile
{
    use TimeStampTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $reseauSocial = null;

    #[ORM\OneToOne(mappedBy: 'profile', cascade: ['persist', 'remove'])]
    private ?Person $person = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $url = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReseauSocial(): ?string
    {
        return $this->reseauSocial;
    }

    public function setReseauSocial(string $reseauSocial): static
    {
        $this->reseauSocial = $reseauSocial;

        return $this;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): static
    {
        // unset the owning side of the relation if necessary
        if ($person === null && $this->person !== null) {
            $this->person->setProfile(null);
        }

        // set the owning side of the relation if necessary
        if ($person !== null && $person->getProfile() !== $this) {
            $person->setProfile($this);
        }

        $this->person = $person;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): static
    {
        $this->url = $url;

        return $this;
    }
}
