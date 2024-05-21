<?php

namespace App\Entity;

use App\Entity\Trait\TimerTrait;
use App\Repository\JobberRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobberRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Jobber
{
    use TimerTrait;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\OneToOne(mappedBy: 'jobber', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setJobber(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getJobber() !== $this) {
            $user->setJobber($this);
        }

        $this->user = $user;

        return $this;
    }

}
